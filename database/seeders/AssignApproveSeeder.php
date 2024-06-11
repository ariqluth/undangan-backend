<?php

namespace Database\Seeders;

use App\Models\AssignApprove;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignApproveSeeder extends Seeder
{

    public function run()
    {
        AssignApprove::insert([
            [
                'kbli_perusahaan_id' => 3,
                'assign_to' => 3,
                'status' => 'pending',
                'perubahan' => 'proses',
                'approve_by' => null,
                'approve_at' => null,
            ],
            [
                'kbli_perusahaan_id' => 11,
                'assign_to' => 3,
                'status' => 'pending',
                'perubahan' => 'proses',
                'approve_by' => null,
                'approve_at' => null,
            ],
            
        ]);
    }
}
