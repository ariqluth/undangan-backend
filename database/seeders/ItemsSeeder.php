<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemsData = [
            [
                'profile_id' => '1',
                'nama_item' => 'Undangan Items 1',
                'gambar' => 'items1.png',
              
            ],

            [
                'profile_id' => '2',
                'nama_item' => 'Undangan Items 2',
                'gambar' => 'items2.png',
              
            ],
          
        ];

        foreach ($itemsData as $data) {
            $filename = basename($data['path']);

            $imageSourcePath = public_path('assets/img/items/' . $filename);
            $imageDestPath = storage_path('app/public/assets/img/items/' . $filename);

            if (file_exists($imageSourcePath)) {
                $destDirectory = dirname($imageDestPath);
                if (!is_dir($destDirectory)) {
                    mkdir($destDirectory, 0755, true);
                }

                if (!copy($imageSourcePath, $imageDestPath)) {
                    echo "Failed to copy $imageSourcePath to $imageDestPath\n";
                } else {
                    unlink($imageSourcePath);
                }

                $data['path'] = 'storage/assets/img/items/' . $filename;
            }

            Items::insert($data);
        }
    }
}
