<?php

namespace Database\Seeders;

use App\Models\KategoriArtikel;
use App\Models\OrderList;
use App\Models\Orders;
use App\Models\Tamus;
use App\Models\VerifyOrder;
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
            ProfilesSeeder::class,
            ItemsSeeder::class,
            Orders::class,
            VerifyOrderSeeder::class,
            OrderList::class,
            UndangansSeeder::class,
            Tamus::class
        ]);
    }
}
