<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $table = "pricelist";
    protected $fillable = ["nama_obat", "exp", "harga_Umum", "harga_BPJS", "harga_Tender1", "harga_Tender2", "harga_Tender3"];
}
