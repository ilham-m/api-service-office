<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_ProductDetail extends Model
{
    use HasFactory;
    public $fillable = [
        'invoice','deskripsi_tagihan','tagihan','urutan'
    ];
}
