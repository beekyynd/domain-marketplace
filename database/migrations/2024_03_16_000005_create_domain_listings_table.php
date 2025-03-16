<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domain_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained();
            $table->enum('marketplace', ['internal', 'aftermarket', 'sedo', 'dan'])->default('internal');
            $table->string('external_listing_id')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('minimum_offer', 10, 2)->nullable();
            $table->boolean('is_premium')->default(false);
            $table->boolean('allow_offers')->default(true);
            $table->boolean('is_active')->default(true);
            $table->json('marketplace_settings')->nullable(); // 市场特定的设置
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['domain_id', 'marketplace']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_listings');
    }
}; 