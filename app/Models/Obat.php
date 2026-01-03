<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'satuan',
        'stok',
        'harga',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'tanggal_kadaluarsa' => 'date',
    ];

    /**
     * Get the medical records that use this medicine.
     */
    public function rekamMedis()
    {
        return $this->belongsToMany(RekamMedis::class, 'rekammedis_obat', 'id_obat', 'id_rekammedis')
            ->withPivot('jumlah', 'aturan_pakai')
            ->withTimestamps();
    }
}
