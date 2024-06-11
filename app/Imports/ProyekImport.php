<?php

namespace App\Imports;

use App\Models\Proyek;
use Maatwebsite\Excel\Concerns\ToModel;

class ProyekImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Proyek([
            //
        ]);
    }
}
