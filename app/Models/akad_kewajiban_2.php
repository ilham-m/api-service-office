<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akad_kewajiban_2 extends Model
{
    use HasFactory;
    public $fillable = [
        'nomor_akad','kewajiban','urutan'
    ];
}
