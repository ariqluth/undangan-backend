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
        'nomer_tamu',
        'alamat_tamu',
        'status',
        'kategori',
        'kodeqr',
    ];


    public function undangans()
    {
    	return $this->belongsTo(Undangans::class);
    }
}
