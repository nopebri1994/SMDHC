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
        Schema::create('overtimeDetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOvertime');
            $table->unsignedBigInteger('idKaryawan');
            $table->integer('jam1');
            $table->integer('jam2');
            $table->text('jenisPekerjaan');
            $table->enum('status', ['0', '1', '2'])->comment('0=tidak dihitung/cancel, 1=diajukan,2=realisasi');

            $table->foreign('idOvertime')->references('id')->on('overtime');
            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimeDetail');
    }
};
