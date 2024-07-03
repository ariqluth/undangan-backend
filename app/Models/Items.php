<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Items extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
    	'user_id',
        'nama_item',
        'gambar',
       
    ];


    public function orders()
    {
        return $this->hasMany(Orders::class, 'item_id');
    }
   


}
