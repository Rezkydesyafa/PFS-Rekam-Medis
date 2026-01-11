<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rm';
    protected $guarded = [];

    // Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id_dokter');
    }

    // Relasi ke Obat (Many-to-Many)
   // Relasi ke Obat (Many-to-Many)
public function obats()
{
    return $this->belongsToMany(Obat::class, 'rekam_medis_obat', 'rekam_medis_id', 'obat_id')
                ->withPivot('jumlah', 'aturan_pakai') // <--- Agar kolom tambahan bisa diambil
                ->withTimestamps();
}



   
}