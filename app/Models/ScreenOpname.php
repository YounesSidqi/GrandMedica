<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenOpname extends Model
{
    use HasFactory;
    protected $table = "screenopname";
    protected $fillable = ["no_seri", "nama_obat", "unit", "exp", "qty"];
}
