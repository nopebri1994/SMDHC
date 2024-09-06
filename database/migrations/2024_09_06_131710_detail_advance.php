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
        Schema::create('detailAdvance', function (Blueprint $table) {
            $table->id();
            $table->string('no_pinjaman');
            $table->date('tanggalProses');
            $table->bigInteger('jumlahPotong');
            $table->integer('potonganKe');
            $table->timestamps();

            $table->foreign('no_pinjaman')->references('no_pinjaman')->on('advance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailAdvance');
    }
};
