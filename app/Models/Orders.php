<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['profile_id', 'item_id', 'kode', 'tanggal_terakhir', 'jumlah', 'status'];

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }

    public function verifyorder()
    {
        return $this->hasMany(VerifyOrder::class, 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
}
