<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class akad_info extends Model
{
    use HasFactory;
    public $fillable = [
        'nomor_akad',
        'nama',
        'nik',
        'alamat',
        'nama_2',
        'nik_2',
        'alamat_2',
        'ket',
        'perjanjian',
        'jangka_waktu',
        'tempat_tanggal',
        'nominal_jasa',
    ];
}
