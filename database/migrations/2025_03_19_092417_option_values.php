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
        Schema::create('option_values', function (Blueprint $table) {
            $table->integer('id')->nullable(false);
            $table->integer('option_id')->nullable(false);
            $table->decimal('price',18,4);
            $table->string('price_type',10);
            $table->integer('position');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_values');
    }
};
