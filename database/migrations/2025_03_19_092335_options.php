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
        Schema::create('options', function (Blueprint $table) {
            $table->integer('id')->nullable(false);
            $table->string('type',191);
            $table->tinyInteger('is_required');
            $table->tinyInteger('is_global');
            $table->integer('position');
            $table->timestamp('deleted_at');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
