<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $table = 'order_list';
    protected $fillable = ['order_id', 'verify_order_id', 'type', 'kode'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function verifyorder()
    {
        return $this->belongsTo(VerifyOrder::class, 'verify_order_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_id');
    }
}
