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
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->string('email')->unique()->nullable();
            $table->string('username');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['1', '2', '3', '4', '5']);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('datakaryawan');
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
