<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name', 191)->nullable();
        $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
        $table->unsignedBigInteger('tax_class_id')->nullable();
        $table->string('slug', 191)->unique();
        $table->decimal('price', 18, 4);
        $table->decimal('special_price', 18, 4)->nullable();
        $table->string('special_price_type', 191)->nullable();
        $table->date('special_price_start')->nullable();
        $table->date('special_price_end')->nullable();
        $table->decimal('selling_price', 18, 4)->nullable();
        $table->string('sku', 191)->nullable();
        $table->boolean('manage_stock')->default(1);
        $table->integer('qty')->default(0);
        $table->boolean('in_stock')->default(1);
        $table->integer('viewed')->default(0);
        $table->boolean('is_active')->default(1);
        $table->dateTime('new_from')->nullable();
        $table->dateTime('new_to')->nullable();
        $table->boolean('is_virtual')->default(0);
        $table->softDeletes();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('products');
}

};
