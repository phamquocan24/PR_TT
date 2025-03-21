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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->nullable(false);
            $table->integer('parent_id')->nullable(false);
            $table->string('slug',191);
            $table->integer('position');
            $table->tinyInteger('is_searchable');
            $table->tinyInteger('is_active');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
