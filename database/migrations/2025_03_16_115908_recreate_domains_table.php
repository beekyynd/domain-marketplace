<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 先禁用外键约束
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('domains');
        
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('tags')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available');
            $table->timestamps();
            $table->softDeletes();
        });

        // 重新启用外键约束
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // 先禁用外键约束
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('domains');

        // 重新启用外键约束
        Schema::enableForeignKeyConstraints();
    }
};
