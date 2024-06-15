<?php

namespace Database\Seeders;


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
            OrdersSeeder::class,
            VerifyOrderSeeder::class,
            OrderListSeeder::class,
            UndangansSeeder::class,
            TamusSeeder::class
        ]);
    }
}
