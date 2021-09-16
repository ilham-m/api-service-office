<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penawaran_detail extends Model
{
    use HasFactory;
    public $fillable = [
      'no_surat_penawaran','penawaran','harga','urutan'
    ];
}
