<?php

namespace Database\Seeders;

use App\Models\Undangans;
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
                    'longitude' => '-7.6309423',
                    'latitude' => '112.0173182',
                ],
                
            ]
        );
    }
}
