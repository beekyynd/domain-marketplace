<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domain_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained();
            $table->foreignId('buyer_id')->constrained('users');
            $table->decimal('amount', 10, 2);
            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'expired',
                'cancelled',
                'countered'
            ])->default('pending');
            $table->text('message')->nullable();
            $table->decimal('counter_offer', 10, 2)->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_offers');
    }
}; 