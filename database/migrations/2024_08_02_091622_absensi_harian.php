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
        Schema::create('absensiHarian', function (Blueprint $table) {
            $table->id();
            $table->integer('idFinger');
            $table->date('tanggalAbsen');
            $table->time('jamAbsen');
            $table->integer('idMesin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensiHarian');
    }
};
