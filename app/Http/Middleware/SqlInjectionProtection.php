<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\SecurityException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SqlInjectionProtection
{
    /**
     * SQL注入危险字符
     */
    protected $patterns = [
        // 基础SQL注入模式
        '/union\s+(?:all\s+)?select/i',
        '/select.*?from/i',
        '/insert\s+into/i',
        '/delete\s+from/i',
        '/drop\s+(?:table|database)/i',
        '/update.*?set/i',
        '/alter\s+table/i',
        '/exec\s*\(/i',
        '/execute\s*\(/i',
        
        // 注释和终止符
        '/;\s*$/i',
        '/--[^\r\n]*$/i',
        '/\/\*.*?\*\//i',
        
        // 条件注入
        '/\'\s*or\s*\'1\'/i',
        '/\'\s*or\s*1--/i',
        '/\'\s*or\s*\'1\'=\'1/i',
        '/\'\s*or\s*1=1/i',
        '/\'\s*or\s*\'a\'=\'a/i',
        
        // 堆叠查询
        '/;\s*select/i',
        '/;\s*insert/i',
        '/;\s*update/i',
        '/;\s*delete/i',
        
        // 时间延迟注入
        '/sleep\s*\(\s*\d+\s*\)/i',
        '/benchmark\s*\(/i',
        '/wait\s*for\s*delay/i',
        
        // 特殊字符
        '/\x00/i',  // Null字节
        '/\x1a/i',  // Ctrl+Z
    ];

    /**
     * 需要检查的参数类型
     */
    protected $checkTypes = [
        'query' => true,     // GET参数
        'request' => true,   // POST参数
        'cookies' => true,   // Cookie（开启检查）
        'headers' => true,   // Header（开启检查）
    ];

    /**
     * 白名单路由
     */
    protected $whitelistRoutes = [
        'api/documentation',
        'api/swagger',
    ];

    /**
     * 处理请求
     */
    public function handle(Request $request, Closure $next)
    {
        // 检查白名单
        if ($this->isWhitelisted($request)) {
            return $next($request);
        }

        // 检查请求频率
        if ($this->isRateLimited($request)) {
            return $this->handleRateLimit($request);
        }

        try {
            if ($this->isSuspiciousRequest($request)) {
                return $this->handleSuspiciousRequest($request);
            }
        } catch (\Exception $e) {
            Log::error('SQL Injection protection error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        return $next($request);
    }

    /**
     * 检查是否为可疑请求
     */
    protected function isSuspiciousRequest(Request $request): bool
    {
        foreach ($this->checkTypes as $type => $shouldCheck) {
            if (!$shouldCheck) continue;

            $parameters = $type === 'headers' 
                ? $request->headers->all() 
                : $request->$type->all();

            if ($this->containsSqlInjection($parameters)) {
                return true;
            }
        }

        // 检查URL路径
        if ($this->containsSqlInjection([$request->path()])) {
            return true;
        }

        return false;
    }

    /**
     * 检查参数是否包含SQL注入
     */
    protected function containsSqlInjection($parameters): bool
    {
        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                if ($this->containsSqlInjection($value)) {
                    return true;
                }
                continue;
            }

            if (!is_string($value)) {
                continue;
            }

            // URL解码检查
            $decodedValue = urldecode($value);
            
            // Base64解码检查
            if (base64_decode($value, true)) {
                $decodedValue .= base64_decode($value);
            }

            // 检查原始值和解码后的值
            foreach ([$value, $decodedValue] as $checkValue) {
                foreach ($this->patterns as $pattern) {
                    if (preg_match($pattern, $checkValue)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * 处理可疑请求
     */
    protected function handleSuspiciousRequest(Request $request)
    {
        // 记录可疑活动
        $this->logSuspiciousActivity($request);
        
        // 增加IP的可疑计数
        $this->incrementSuspiciousCount($request);

        // 检查是否需要自动封禁IP
        if ($this->shouldBlockIp($request)) {
            $this->blockIp($request);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Security violation detected',
                'code' => 'SECURITY_VIOLATION',
                'message' => 'Your request has been blocked for security reasons'
            ], 403);
        }

        throw new SecurityException('Security violation detected');
    }

    /**
     * 记录可疑活动
     */
    protected function logSuspiciousActivity(Request $request): void
    {
        $details = [
            'uri' => $request->getUri(),
            'method' => $request->getMethod(),
            'parameters' => $this->sanitizeData($request->all()),
            'headers' => $this->sanitizeData($request->headers->all()),
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer'),
        ];

        \DB::table('suspicious_activities')->insert([
            'ip_address' => $request->ip(),
            'user_id' => auth()->id(),
            'activity_type' => 'sql_injection_attempt',
            'details' => json_encode($details),
            'detected_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Log::warning('SQL Injection attempt detected', $details);
    }

    /**
     * 清理敏感数据
     */
    protected function sanitizeData(array $data): array
    {
        $sensitiveKeys = ['password', 'token', 'key', 'secret'];
        
        return array_map(function ($value) use ($sensitiveKeys) {
            if (is_array($value)) {
                return $this->sanitizeData($value);
            }
            
            if (is_string($value) && $this->isSensitiveKey($value, $sensitiveKeys)) {
                return '******';
            }
            
            return $value;
        }, $data);
    }

    /**
     * 检查是否为敏感键
     */
    protected function isSensitiveKey(string $key, array $sensitiveKeys): bool
    {
        return str_contains(strtolower($key), $sensitiveKeys);
    }

    /**
     * 检查是否在白名单中
     */
    protected function isWhitelisted(Request $request): bool
    {
        return in_array($request->path(), $this->whitelistRoutes);
    }

    /**
     * 检查请求频率限制
     */
    protected function isRateLimited(Request $request): bool
    {
        $key = 'sql_injection_check:' . $request->ip();
        $attempts = Cache::get($key, 0);
        
        return $attempts > 10; // 10次/分钟
    }

    /**
     * 处理频率限制
     */
    protected function handleRateLimit(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Too many suspicious requests',
                'code' => 'RATE_LIMIT_EXCEEDED'
            ], 429);
        }

        throw new SecurityException('Too many suspicious requests');
    }

    /**
     * 增加可疑计数
     */
    protected function incrementSuspiciousCount(Request $request): void
    {
        $key = 'sql_injection_check:' . $request->ip();
        $attempts = Cache::get($key, 0);
        
        Cache::put($key, $attempts + 1, now()->addMinutes(1));
    }

    /**
     * 检查是否应该封禁IP
     */
    protected function shouldBlockIp(Request $request): bool
    {
        $key = 'sql_injection_check:' . $request->ip();
        $attempts = Cache::get($key, 0);
        
        return $attempts >= 5; // 5次尝试后自动封禁
    }

    /**
     * 封禁IP
     */
    protected function blockIp(Request $request): void
    {
        \DB::table('ip_blacklists')->insert([
            'ip_address' => $request->ip(),
            'reason' => 'Automated block due to multiple SQL injection attempts',
            'blocked_until' => now()->addHours(24),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
} 