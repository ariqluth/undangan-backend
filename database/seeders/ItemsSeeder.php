<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;


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
                'user_id' => '1',
                'nama_item' => 'Undangan Items 1',
                'gambar' => 'items1.png',
              
            ],

            [
                'user_id' => '1',
                'nama_item' => 'Undangan Items 2',
                'gambar' => 'items2.png',
              
            ],
          
        ];

        foreach ($itemsData as $data) {
            $filename = basename($data['gambar']);

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

                $data['gambar'] = 'storage/assets/img/items/' . $filename;
            }

            Items::insert($data);
        }
    }
}
