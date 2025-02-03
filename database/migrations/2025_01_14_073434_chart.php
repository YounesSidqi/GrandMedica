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
        Schema::create('chart', function (Blueprint $table) {
            $table->id();
            $table->string('no_seri');
            $table->string('nama_obat');
            $table->string('hari');
            $table->string('minggu');
            $table->string('bulan');
            $table->string('total_profit')->default(0);;
            $table->string('total_pengeluaran')->default(0);;
            $table->string('total_pemasukan')->default(0);;
            $table->string('pengeluaran')->default(0);;
            $table->string('pemasukan')->default(0);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
