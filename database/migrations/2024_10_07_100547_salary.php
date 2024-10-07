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
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->enum('gpCek', ['0', '1']);
            $table->bigInteger('gp')->nullable();
            $table->enum('tjMakanCek', ['0', '1']);
            $table->bigInteger('tjMakan')->nullable();
            $table->enum('tjTransportCek', ['0', '1']);
            $table->bigInteger('tjTransport')->nullable();
            $table->enum('status', ['Aktif', 'Tidak']);
            $table->bigInteger('tjJabatan')->nullable();
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary');
    }
};
