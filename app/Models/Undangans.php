<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangans extends Model
{
    use HasFactory;
    protected $table = 'undangans';
    protected $fillable = [
        'order_id', 'order_list_id', 'nama_pengantin_pria', 'nama_pengantin_wanita', 'tanggal_pernikahan', 'lokasi_pernikahan'
    ];

    public function order()
    {
    	return $this->belongsTo(Orders::class);
    }

    public function order_list()
    {
    	return $this->belongsTo(OrderList::class);
    }


}
