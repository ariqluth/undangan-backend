<?php

namespace Database\Seeders;

use App\Models\OrderList;
use Illuminate\Database\Seeder;

class OrderListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderList::insert(
            [
                [
                    'order_id' => '1',
                    'verify_order_id' => '1',
                    'type' => 'proses',
                    'kode' => 'TY1232',
                ],
                
            ]
        );
    }
}
