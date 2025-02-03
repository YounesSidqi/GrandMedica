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
        Schema::create('kasir', function (Blueprint $table) {
            $table->id();
            $table->string('no_seri');
            $table->string('nama_obat');
            $table->string('exp');
            $table->integer('qty');
            $table->integer('harga_Umum');
            $table->integer('harga_BPJS');
            $table->integer('harga_Tender1');
            $table->integer('harga_Tender2');
            $table->integer('harga_Tender3');
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
