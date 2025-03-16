<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domain_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained();
            $table->enum('service_type', ['parking', 'forwarding', 'dns_management'])->default('parking');
            $table->json('configuration')->nullable(); // 服务具体配置
            $table->boolean('is_active')->default(true);
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_services');
    }
}; 