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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->nullable(false);
            $table->string('frist_name',191);
            $table->string('last_name',191);
            $table->string('email',191);
            $table->string('phone',191);
            $table->string('password',191);
            $table->text('role');
            $table->dateTime('last_login');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
