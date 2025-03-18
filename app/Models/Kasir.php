<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = "kasir";
    protected $fillable = ["no_seri", "nama_obat", "exp", "qty", "harga_Umum"];

     // Relasi ke ScreenOpname
     public function screenOpname()
     {
         return $this->belongsTo(ScreenOpname::class);
     }
 
     // Relasi ke PriceList
     public function priceList()
     {
         return $this->belongsTo(PriceList::class, 'no_seri', 'no_seri');
     }
}
