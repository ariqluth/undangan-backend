<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            MenuGroupSeeder::class,
            MenuItemSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            ProfilePengusahaSeeder::class,
            KBLISeeder::class,
            PenanamanModalSeeder::class,
            UraianJenisPerusahaanSeeder::class,
            UraianResikoProyekSeeder::class,
            UraianSkalaUsahaSeeder::class,
            PerusahaanSeeder::class,
            KbliPerusahaanSeeder::class,
            AssignApproveSeeder::class,
            KategoriArtikelSeeder::class,
            // GambarKbliPerusahaanSeeder::class,
            ArtikelSeeder::class,
            ArtikelKategoriJoinSeeder::class,
        ]);
    }
}
