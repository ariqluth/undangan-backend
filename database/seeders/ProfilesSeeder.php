<?php

namespace Database\Seeders;

use App\Models\Profiles;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    public function run()
    {
        Profiles::insert ([
            [
                'user_id' => '2',
                'username'=> 'lumina',
                'nomer_telepon'=> '082151234567912',
                'alamat'=> 'Malang',
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
