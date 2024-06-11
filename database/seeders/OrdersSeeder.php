<?php

namespace Database\Seeders;

use App\Models\Orders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orders::insert ([
            [
                'profile_id' => '2',
                'item_id'=> '1',
                'kode'=> 'G101',
                'tanggal_terakhir'=> '2024-05-12',
                'status'=> 'pending',
            ],
            [
                'profile_id' => '3',
                'item_id'=> '2',
                'kode'=> 'G102',
                'tanggal_terakhir'=> '2024-05-12',
                'status'=> 'pending',
            ],
           
         
            ]);
    }
}
