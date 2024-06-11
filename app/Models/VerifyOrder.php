<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyOrder extends Model
{
    use HasFactory;
    protected $table = 'verify_order';
    protected $fillable = ['order_id', 'profile_id'];

    public function order()
    {
    	return $this->belongsTo(Orders::class);
    }
    public function Profile()
    {
    	return $this->belongsTo(Profiles::class);
    }
}
