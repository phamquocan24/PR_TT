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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->integer('id')->nullable(false);
            $table->string('uid',191);
            $table->text('uids');
            $table->integer('product_id')->nullable(false);
            $table->string('name',191);
            $table->decimal('price',18,4);
            $table->decimal('special_price',18,4);
            $table->string('special_price_type',191);
            $table->date('special_price_start');
            $table->date('special_price_end');
            $table->decimal('selling_price',18,4);
            $table->string('sku',191);
            $table->tinyInteger('manage_stock');
            $table->integer('qty');
            $table->tinyInteger('in_stock');
            $table->tinyInteger('is_default');
            $table->tinyInteger('is_active');
            $table->integer('position');
            $table->timestamp('deleted_at');      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
