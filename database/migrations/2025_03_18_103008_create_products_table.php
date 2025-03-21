<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('tax_class_id');
            $table->string('slug', 191)->nullable();
            $table->decimal('price', 18, 4)->nullable();
            $table->decimal('special_price', 18, 4)->nullable();
            $table->string('special_price_type', 191)->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4)->nullable();
            $table->string('sku', 191)->nullable();
            $table->boolean('manage_stock')->default(0);
            $table->integer('qty')->default(0);
            $table->boolean('in_stock')->default(0);
            $table->integer('viewed')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamp('new_from')->nullable();
            $table->timestamp('new_to')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
