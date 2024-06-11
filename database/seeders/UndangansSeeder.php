<?php

namespace Database\Seeders;

use App\Models\Undangans;
use App\Models\UraianSkalaUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UndangansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Undangans::insert(
            [
                [
                    'order_id' => '1',
                    'order_list_id' => '1',
                    'nama_pengantin_pria' => 'Hanasaki',
                    'nama_pengantin_wanita' => 'Kosibo',
                    'tanggal_pernikahan' => '2024-12-04',
                    'lokasi_pernikahan' => 'Nganjuk',
                ],
                
            ]
        );
    }
}
