<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;

    protected $table = 'transaction_details'; // Tambahkan ini

    protected $fillable = [
        'transaction_id',
        'no_seri',
        'nama_obat',
        'harga_Umum',
        'qty',
        'total_qty',
        'harga_total',
        'exp',
    ];
}
