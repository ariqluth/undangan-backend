<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamus extends Model
{
    use HasFactory;
    protected $table = 'tamus';

    protected $fillable = [
    	'undangan_id',
        'nama_tamu',
        'email_tamu',
        'nomer_tamu',
        'alamat_tamu',
        'status',
        'kategori',
        'kodeqr',
        'tipe_undangan',
    ];


    public function undangans()
    {
    	return $this->belongsTo(Undangans::class, 'undangan_id');
    }
}
