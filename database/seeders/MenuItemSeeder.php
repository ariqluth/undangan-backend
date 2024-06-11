<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::insert(
            [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'permission_name' => 'dashboard',
                    'menu_group_id' => 1,
                ],
                [
                    'name' => 'Geo Location',
                    'route' => 'data-table-management/geo-location',
                    'permission_name' => 'geo-location.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Kabupaten',
                    'route' => 'master-table-management/kabupaten',
                    'permission_name' => 'kabupaten.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Kecamatan',
                    'route' => 'master-table-management/kecamatan',
                    'permission_name' => 'kecamatan.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Kelurahan',
                    'route' => 'master-table-management/kelurahan',
                    'permission_name' => 'kelurahan.index',
                    'menu_group_id' => 3,
                ],

                [
                    'name' => 'Uraian Jenis Perusahaan',
                    'route' => 'master-table-management/uraian-jenis-perusahaan',
                    'permission_name' => 'uraian-jenis-perusahaan.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Uraian Resiko Proyek',
                    'route' => 'master-table-management/uraian-resiko-proyek',
                    'permission_name' => 'uraian-resiko-proyek.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Uraian Skala Usaha',
                    'route' => 'master-table-management/uraian-skala-usaha',
                    'permission_name' => 'uraian-skala-usaha.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'KBLI',
                    'route' => 'master-table-management/kbli',
                    'permission_name' => 'kbli.index',
                    'menu_group_id' => 3,
                ],

                [
                    'name' => 'Profile Pengusaha',
                    'route' => 'data-table-management/profile-pengusaha',
                    'permission_name' => 'profile-pengusaha.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Perusahaan',
                    'route' => 'data-table-management/perusahaan',
                    'permission_name' => 'perusahaan.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'KBLI Perusahaan',
                    'route' => 'data-table-management/kbli-perusahaan',
                    'permission_name' => 'kbli-perusahaan.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Artikel',
                    'route' => 'artikel-management/artikel',
                    'permission_name' => 'artikel.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Kategori Artikel',
                    'route' => 'artikel-management/kategori-artikel',
                    'permission_name' => 'kategori-artikel.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Assign Approve',
                    'route' => 'penugasan-management/assign-approve',
                    'permission_name' => 'assign-approve.index',
                    'menu_group_id' => 6,
                ],

                [
                    'name' => 'Assign Approve Security',
                    'route' => 'security-management/assign-approve-security',
                    'permission_name' => 'keamanan.assignapprove-index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Kbli Perusahaan Security',
                    'route' => 'security-management/kbli-perusahaan-security',
                    'permission_name' => 'keamanan.kbliperusahaan-index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'User List',
                    'route' => 'user-management/user',
                    'permission_name' => 'user.index',
                    'menu_group_id' => 8,
                ],
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => 9,
                ],
                [
                    'name' => 'Permission List',
                    'route' => 'role-and-permission/permission',
                    'permission_name' => 'permission.index',
                    'menu_group_id' => 9,
                ],
                [
                    'name' => 'Permission To Role',
                    'route' => 'role-and-permission/assign',
                    'permission_name' => 'assign.index',
                    'menu_group_id' => 9,
                ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => 9,
                ],
                [
                    'name' => 'Menu Group',
                    'route' => 'menu-management/menu-group',
                    'permission_name' => 'menu-group.index',
                    'menu_group_id' => 10,
                ],
                [
                    'name' => 'Menu Item',
                    'route' => 'menu-management/menu-item',
                    'permission_name' => 'menu-item.index',
                    'menu_group_id' => 10,
                ]

            ]
        );
    }
}
