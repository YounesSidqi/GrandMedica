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
            $table->string('harga_Umum')->default(0);;
            $table->string('harga_BPJS')->default(0);;
            $table->string('harga_Tender')->default(0);;
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
