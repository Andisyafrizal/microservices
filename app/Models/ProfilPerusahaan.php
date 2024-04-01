<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'profil_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'deskripsi',
        'lokasi',
        'jam_masuk',
        'jam_pulang',
        'image',

    ];
}
