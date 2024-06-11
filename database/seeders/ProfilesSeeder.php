<?php

namespace Database\Seeders;

use App\Models\ArtikelKategoriJoin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Profiles::insert ([
            [
                'user_id' => '2',
                'username'=> 'lumina',
                'nomer_telepon'=> '082151234567912',
                'alamat'=> 'Malang',
            ],
            [
                'user_id' => '2',
                'username'=> 'tirta',
                'nomer_telepon'=> '082151234567913',
                'alamat'=> 'Nganjuk',
            ],
            [
                'user_id' => '3',
                'username'=> 'batara',
                'nomer_telepon'=> '082151234567913',
                'alamat'=> 'Nganjuk',
            ],
         
            ]);
    }
}
