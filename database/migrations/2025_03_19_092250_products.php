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
            $table->integer('id')->nullable(false);
            $table->integer('brand_id')->nullable(false);
            $table->integer('tax_class_id')->nullable(false);
            $table->string('slug',191);
            $table->decimal('price');
            $table->decimal('special_price',18,4);
            $table->string('special_price_type',191);
            $table->date('special_price_start');
            $table->date('special_price_end');
            $table->decimal('selling_price',18,4);
            $table->string('sku',191);
            $table->tinyInteger('manage_stock');
            $table->integer('qty');
            $table->tinyInteger('in_stock');
            $table->integer('viewed');
            $table->tinyInteger('is_active');
            $table->dateTime('new_from');
            $table->dateTime('new_to');
            $table->timestamp('deleted_at');      
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
