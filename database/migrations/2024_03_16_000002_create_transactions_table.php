<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained();
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->decimal('amount', 10, 2);
            $table->enum('status', [
                'pending',
                'escrow_created',
                'payment_sent',
                'payment_verified',
                'transfer_initiated',
                'transfer_completed',
                'completed',
                'failed',
                'refunded',
                'cancelled'
            ])->default('pending');
            $table->string('payment_provider')->nullable(); // escrow or atom
            $table->string('payment_id')->nullable(); // 外部支付ID
            $table->json('payment_details')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}; 