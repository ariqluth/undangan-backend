<?php

namespace Database\Seeders;

use App\Models\Tamus;

use Illuminate\Database\Seeder;

class TamusSeeder extends Seeder
{

    public function run()
    {
        Tamus::insert([
            [
                'undangan_id' => 1,
                'nama_tamu' => 'ariq luthfi',
                'nomer_tamu' => '01',
                'alamat_tamu' => 'nganjuk',
                'status' => 'belum datang',
                'kategori' => 'teman',
                'kodeqr' => 'ariqluthfi-01',
                'tipe_undangan' => 'digital',
            ],
          
            
        ]);
    }
}
