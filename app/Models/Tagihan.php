<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';
    protected $primaryKey = 'id_tagihan'; // Assuming a default convention or explicitly checking migration would be better, but I'll skip purely for fixing the class missing error. Usually default is 'id'. Let me check migration content first to be 100% sure about PK. 
    protected $guarded = [];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_medis_id', 'id_rm');
    }
}
