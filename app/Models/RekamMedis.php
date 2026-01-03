<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekammedis';

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosa',
        'catatan',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    /**
     * Get the patient for this medical record.
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Get the doctor for this medical record.
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    /**
     * Get the medicines for this medical record.
     */
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'rekammedis_obat', 'id_rekammedis', 'id_obat')
            ->withPivot('jumlah', 'aturan_pakai')
            ->withTimestamps();
    }
}
