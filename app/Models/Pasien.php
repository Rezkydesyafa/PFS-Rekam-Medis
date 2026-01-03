<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'name',
        'nik',
        'no_rm',
        'tgl_lahir',
        'jenis_kelamin',
        'gol_darah',
        'status_nikah',
        'no_hp',
        'email',
        'alamat',
        'status',
    ];
}
