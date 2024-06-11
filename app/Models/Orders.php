<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['profile_id', 'item_id', 'kode', 'tanggal_terakhir', 'status'];

    public function profile()
    {
        return $this->belongsToMany(Profiles::class);
    }

    public function item()
    {
        return $this->belongsToMany(Profiles::class);
    }

}
