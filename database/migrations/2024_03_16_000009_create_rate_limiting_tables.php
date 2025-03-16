<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // IP黑名单表
        Schema::create('ip_blacklists', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->unique();
            $table->text('reason');
            $table->timestamp('blocked_until')->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->timestamps();
        });

        // 请求限制表
        Schema::create('rate_limits', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // IP或用户ID
            $table->string('type'); // api, login, offer等
            $table->integer('attempts');
            $table->timestamp('reset_at');
            $table->timestamps();
        });

        // 可疑活动记录表
        Schema::create('suspicious_activities', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('activity_type');
            $table->json('details');
            $table->boolean('is_resolved')->default(false);
            $table->text('resolution_notes')->nullable();
            $table->timestamp('detected_at');
            $table->timestamps();
        });

        // 安全设置表
        Schema::create('security_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->string('type'); // boolean, integer, json等
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('security_settings');
        Schema::dropIfExists('suspicious_activities');
        Schema::dropIfExists('rate_limits');
        Schema::dropIfExists('ip_blacklists');
    }
}; 