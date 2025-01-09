<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $table = "pricelist";
    protected $fillable = ["nama_obat", "harga_Umum", "harga_BPJS", "harga_Tender"];
}
