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
        Schema::create('hutangcuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->integer('jumlahHutangCuti');
            $table->integer('ambilHutangCuti');
            $table->text('keterangan');
            $table->date('expired');
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('datakaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutangCuti');
    }
};
