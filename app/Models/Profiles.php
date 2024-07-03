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
     
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class, 'profile_id');
    }

    public function verifyorder()
    {
        return $this->hasMany(VerifyOrder::class, 'profile_id');
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
