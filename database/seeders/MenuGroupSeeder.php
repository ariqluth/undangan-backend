<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuGroup::insert(
            [
                [
                    'name' => 'Dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'permission_name' => 'dashboard',
                    'position' => 1
                ],
                [
                    'name' => 'Map',
                    'icon' => 'fas fa-map',
                    'permission_name' => 'data-table.management',
                    'position' => 2
                ],
                [
                    'name' => 'Table Management',
                    'icon' => 'fas fa-table',
                    'permisison_name' => 'master-table.management',
                    'position' => 3

                ],
                [
                    'name' => 'Data Management',
                    'icon' => 'fas fa-database',
                    'permisison_name' => 'data-table.management',
                    'position' => 4

                ],
                [
                    'name' => 'Artikel',
                    'icon' => 'fas fa-newspaper',
                    'permission_name' => 'artikel.management',
                    'position' => 5
                ],
                [
                    'name' => 'Penugasan',
                    'icon' => 'fas fa-bookmark',
                    'permisison_name' => 'penugasan.management',
                    'position' => 6

                ],
                [
                    'name' => 'Security Management',
                    'icon' => 'fas fa-user-shield',
                    'permission_name' => 'security.management',
                    'position' => 7

                ],
                [
                    'name' => 'Users Management',
                    'icon' => 'fas fa-users',
                    'permission_name' => 'user.management',
                    'position' => 8

                ],
                [
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permisison_name' => 'role.permission.management',
                    'position' => 9

                ],
                [
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permisison_name' => 'menu.management',
                    'position' => 10

                ]
            ]
        );
    }
}
