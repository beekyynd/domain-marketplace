<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // escrow, atom
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->string('redirect_url')->nullable();
            $table->json('configuration')->nullable(); // API endpoints, webhook URLs等配置
            $table->boolean('is_active')->default(true);
            $table->decimal('minimum_amount', 10, 2)->default(0);
            $table->decimal('maximum_amount', 10, 2)->nullable();
            $table->decimal('fee_percentage', 5, 2)->default(0);
            $table->decimal('fixed_fee', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_providers');
    }
}; 