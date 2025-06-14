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
        Schema::create('pricelist', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('exp');
            $table->integer('harga_Umum')->default(0);;
            $table->integer('harga_BPJS')->default(0);;
            $table->integer('harga_Tender1')->default(0);;
            $table->integer('harga_Tender2')->default(0);;
            $table->integer('harga_Tender3')->default(0);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricelist');
    }
};
