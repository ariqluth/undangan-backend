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
    	return $this->belongsTo(Orders::class);
    }

    public function verify_order()
    {
    	return $this->belongsTo(VerifyOrder::class);
    }
}
