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
        Schema::create('settingSalary', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gp');
            $table->bigInteger('tjMakan');
            $table->bigInteger('tjTransport');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settingSalary');
    }
};
