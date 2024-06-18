<?php

namespace Database\Seeders;

use App\Models\UraianJenisPerusahaan;
use App\Models\VerifyOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerifyOrderSeeder extends Seeder
{
    public function run()
    {
        VerifyOrder::insert(
            [
                [
                    'order_id' => '1',
                    'profile_id' => '1',
                ],
                [
                    'order_id' => '2',
                    'profile_id' => '2',
                ],
                
            ]
        );
    }
}
