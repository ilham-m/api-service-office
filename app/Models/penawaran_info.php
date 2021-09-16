<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penawaran_info extends Model
{
    use HasFactory;
    public $fillable = [
        'ket_penawaran','nama','no_surat_penawaran','tanggal'
    ];
}
