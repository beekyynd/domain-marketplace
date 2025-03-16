<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domain_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('domain_category_pivot', function (Blueprint $table) {
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('domain_categories')->onDelete('cascade');
            $table->primary(['domain_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_category_pivot');
        Schema::dropIfExists('domain_categories');
    }
}; 