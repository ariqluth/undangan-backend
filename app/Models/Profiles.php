<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
    	'user_id',
        'username',
        'nomer_telepon',
        'alamat',
        'gambar',
    ];


    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
