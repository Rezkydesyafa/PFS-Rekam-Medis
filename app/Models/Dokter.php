<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';
    protected $primaryKey = 'id_dokter';

    protected $fillable = [
    'nama_dokter',
    'spesialisasi',
    'tarif', // <--- Tambahkan ini
    'no_sip',
    'no_telepon',
];
    /**
     * Get the medical records handled by this doctor.
     */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_dokter', 'id_dokter');
    }
}
