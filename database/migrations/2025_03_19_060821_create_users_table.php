<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('uusers')) {
            Schema::create('uusers', function (Blueprint $table) {
                $table->id();
                $table->string('first_name', 191)->nullable();
                $table->string('last_name', 191)->nullable();
                $table->string('email', 191)->unique();
                $table->string('phone', 191)->nullable();
                $table->string('password', 191);
                $table->text('role')->nullable();
                $table->timestamp('last_login')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uusers');
    }
};
