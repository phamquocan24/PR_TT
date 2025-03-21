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
            $table->bigIncrements('id')->nullable(false);
            $table->unsignedBigInteger('brand_id')->nullable(false);
            $table->integer('tax_class_id');
            $table->string('slug', 191);
            $table->decimal('price', 18, 4);
            $table->string('special_price_type', 191);
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4);
            $table->string('sku', 191);
            $table->tinyInteger('manage_stock');
            $table->integer('qty');
            $table->tinyInteger('in_stock');
            $table->integer('viewed');
            $table->tinyInteger('is_active');
            $table->dateTime('new_from')->nullable();
            $table->dateTime('new_to')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
