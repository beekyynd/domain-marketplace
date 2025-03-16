<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class Domain extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'seller_id',
        'status',
        'registrar',
        'registration_date',
        'expiry_date',
        'nameservers',
        'is_verified'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'nameservers' => 'encrypted:array',
        'is_verified' => 'boolean',
        'registration_date' => 'date',
        'expiry_date' => 'date',
        'last_verification' => 'datetime',
        'price' => 'decimal:2'
    ];

    /**
     * 域名验证规则
     */
    protected $validationRules = [
        'name' => [
            'required',
            'string',
            'max:255',
            'regex:/^(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/',
            'unique:domains,name'
        ],
        'description' => 'nullable|string|max:1000',
        'price' => 'required|numeric|min:0|max:999999999.99',
        'seller_id' => 'required|exists:users,id',
        'status' => 'required|in:available,pending,sold,reserved',
        'registrar' => 'nullable|string|max:255',
        'registration_date' => 'nullable|date',
        'expiry_date' => 'nullable|date|after:registration_date',
        'nameservers' => 'nullable|array',
        'nameservers.*' => 'string|max:255|regex:/^(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/',
        'is_verified' => 'boolean'
    ];

    /**
     * 保存前验证
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validate();
        });
    }

    /**
     * 验证模型数据
     */
    public function validate()
    {
        $validator = Validator::make(
            $this->attributes,
            $this->validationRules
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * 安全的搜索范围
     */
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        // 验证搜索参数
        $validator = Validator::make(['search' => $search], [
            'search' => [
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\.\-]+$/'
            ]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // 使用参数绑定而不是字符串拼接
        return $query->where('name', 'LIKE', "%{$search}%");
    }

    /**
     * 安全的排序范围
     */
    public function scopeSort($query, $field, $direction = 'asc')
    {
        $allowedFields = [
            'name',
            'price',
            'created_at',
            'status',
            'registration_date',
            'expiry_date'
        ];

        $allowedDirections = ['asc', 'desc'];

        // 验证排序参数
        $validator = Validator::make([
            'field' => $field,
            'direction' => $direction
        ], [
            'field' => 'required|in:' . implode(',', $allowedFields),
            'direction' => 'required|in:' . implode(',', $allowedDirections)
        ]);

        if ($validator->fails()) {
            return $query->orderBy('created_at', 'desc');
        }

        return $query->orderBy($field, strtolower($direction));
    }

    /**
     * 价格范围过滤
     */
    public function scopePriceRange($query, $min, $max)
    {
        $validator = Validator::make([
            'min' => $min,
            'max' => $max
        ], [
            'min' => 'nullable|numeric|min:0|max:999999999.99',
            'max' => 'nullable|numeric|min:0|max:999999999.99'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if ($min !== null) {
            $query->where('price', '>=', (float)$min);
        }

        if ($max !== null) {
            $query->where('price', '<=', (float)$max);
        }

        return $query;
    }

    /**
     * 缓存查询结果
     */
    public function scopeCached($query, $minutes = 60)
    {
        $key = 'domain:' . md5(serialize($query->toSql()) . serialize($query->getBindings()));
        
        return Cache::remember($key, now()->addMinutes($minutes), function () use ($query) {
            return $query->get();
        });
    }

    /**
     * 检查域名格式是否有效
     */
    public static function isValidDomainName($name)
    {
        return (bool)preg_match(
            '/^(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/',
            $name
        );
    }

    /**
     * 清理域名数据
     */
    public static function sanitizeDomainName($name)
    {
        // 移除危险字符
        $name = preg_replace('/[^a-zA-Z0-9\.\-]/', '', $name);
        // 转换为小写
        return strtolower($name);
    }
} 