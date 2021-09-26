<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akad_objek extends Model
{
    use HasFactory;
    public $fillable = [
        'nomor_akad','objek_perjanjian','subjek_perjanjian','ket_objek','urutan'
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];
}
