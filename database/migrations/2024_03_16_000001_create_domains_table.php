<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('seller_id')->constrained('users');
            $table->enum('status', ['available', 'pending', 'sold', 'reserved'])->default('available');
            $table->string('registrar')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->json('nameservers')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('last_verification')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domains');
    }
}; 