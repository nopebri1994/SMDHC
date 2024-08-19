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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->char('idKeteranganIjin');
            $table->string('tanggalIjin');
            $table->enum('status', ['0', '1']);
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
            $table->foreign('idKeteranganIjin')->references('id')->on('keteranganIjin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
