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
                                    ],
                [
                    'name' => 'Map',
                    'icon' => 'fas fa-map',
                    'permission_name' => 'data-table.management',
                                    ],
                [
                    'name' => 'Table Management',
                    'icon' => 'fas fa-table',
                    'permisison_name' => 'master-table.management',
                    
                ],
                [
                    'name' => 'Data Management',
                    'icon' => 'fas fa-database',
                    'permisison_name' => 'data-table.management',
                    
                ],
                [
                    'name' => 'Artikel',
                    'icon' => 'fas fa-newspaper',
                    'permission_name' => 'artikel.management',
                                    ],
                [
                    'name' => 'Penugasan',
                    'icon' => 'fas fa-bookmark',
                    'permisison_name' => 'penugasan.management',
                    
                ],
                [
                    'name' => 'Security Management',
                    'icon' => 'fas fa-user-shield',
                    'permission_name' => 'security.management',
                    
                ],
                [
                    'name' => 'Users Management',
                    'icon' => 'fas fa-users',
                    'permission_name' => 'user.management',
                    
                ],
                [
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permisison_name' => 'role.permission.management',
                    
                ],
                [
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permisison_name' => 'menu.management',
                    

                ]
            ]
        );
    }
}
