<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'user.management']);
        Permission::create(['name' => 'role.permission.management']);
        Permission::create(['name' => 'menu.management']);
        Permission::create(['name' => 'master-table.management']);
        Permission::create(['name' => 'data-table.management']);
        Permission::create(['name' => 'artikel.management']);
        Permission::create(['name' => 'penugasan.management']);
        Permission::create(['name' => 'security.management']);

        //user
        Permission::create(['name' => 'visitor.index']);
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.import']);
        Permission::create(['name' => 'user.export']);

        //role
        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.destroy']);
        Permission::create(['name' => 'role.import']);
        Permission::create(['name' => 'role.export']);

        //permission
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.destroy']);
        Permission::create(['name' => 'permission.import']);
        Permission::create(['name' => 'permission.export']);

        //assignpermission
        Permission::create(['name' => 'assign.index']);
        Permission::create(['name' => 'assign.create']);
        Permission::create(['name' => 'assign.edit']);
        Permission::create(['name' => 'assign.destroy']);

        //assingusertorole
        Permission::create(['name' => 'assign.user.index']);
        Permission::create(['name' => 'assign.user.create']);
        Permission::create(['name' => 'assign.user.edit']);

        //menu group
        Permission::create(['name' => 'menu-group.index']);
        Permission::create(['name' => 'menu-group.create']);
        Permission::create(['name' => 'menu-group.edit']);
        Permission::create(['name' => 'menu-group.destroy']);

        //menu item
        Permission::create(['name' => 'menu-item.index']);
        Permission::create(['name' => 'menu-item.create']);
        Permission::create(['name' => 'menu-item.edit']);
        Permission::create(['name' => 'menu-item.destroy']);

        //kabupaten
        Permission::create(['name' => 'kabupaten.index']);
        Permission::create(['name' => 'kabupaten.create']);
        Permission::create(['name' => 'kabupaten.edit']);
        Permission::create(['name' => 'kabupaten.destroy']);

        //kecamatan
        Permission::create(['name' => 'kecamatan.index']);
        Permission::create(['name' => 'kecamatan.create']);
        Permission::create(['name' => 'kecamatan.edit']);
        Permission::create(['name' => 'kecamatan.destroy']);

        //kelurahan
        Permission::create(['name' => 'kelurahan.index']);
        Permission::create(['name' => 'kelurahan.create']);
        Permission::create(['name' => 'kelurahan.edit']);
        Permission::create(['name' => 'kelurahan.destroy']);

        //kbli
        Permission::create(['name' => 'kbli.index']);
        Permission::create(['name' => 'kbli.create']);
        Permission::create(['name' => 'kbli.edit']);
        Permission::create(['name' => 'kbli.destroy']);

        //Artikel
        Permission::create(['name' => 'artikel.index']);
        Permission::create(['name' => 'artikel.create']);
        Permission::create(['name' => 'artikel.edit']);
        Permission::create(['name' => 'artikel.destroy']);

        //Kategori Artikel
        Permission::create(['name' => 'kategori-artikel.index']);
        Permission::create(['name' => 'kategori-artikel.create']);
        Permission::create(['name' => 'kategori-artikel.edit']);
        Permission::create(['name' => 'kategori-artikel.destroy']);


        //uraian-jenis-perusahaan
        Permission::create(['name' => 'uraian-jenis-perusahaan.index']);
        Permission::create(['name' => 'uraian-jenis-perusahaan.create']);
        Permission::create(['name' => 'uraian-jenis-perusahaan.edit']);
        Permission::create(['name' => 'uraian-jenis-perusahaan.destroy']);

        //uraian-resiko-proyek
        Permission::create(['name' => 'uraian-resiko-proyek.index']);
        Permission::create(['name' => 'uraian-resiko-proyek.create']);
        Permission::create(['name' => 'uraian-resiko-proyek.edit']);
        Permission::create(['name' => 'uraian-resiko-proyek.destroy']);

        //uraian-skala-usaha
        Permission::create(['name' => 'uraian-skala-usaha.index']);
        Permission::create(['name' => 'uraian-skala-usaha.create']);
        Permission::create(['name' => 'uraian-skala-usaha.edit']);
        Permission::create(['name' => 'uraian-skala-usaha.destroy']);

        //profile-pengusaha
        Permission::create(['name' => 'profile-pengusaha.index']);
        Permission::create(['name' => 'profile-pengusaha.create']);
        Permission::create(['name' => 'profile-pengusaha.edit']);
        Permission::create(['name' => 'profile-pengusaha.destroy']);

        //perusahaan
        Permission::create(['name' => 'perusahaan.index']);
        Permission::create(['name' => 'perusahaan.create']);
        Permission::create(['name' => 'perusahaan.edit']);
        Permission::create(['name' => 'perusahaan.destroy']);


        //kbli-perusaaan
        Permission::create(['name' => 'kbli-perusahaan.index']);
        Permission::create(['name' => 'kbli-perusahaan.create']);
        Permission::create(['name' => 'kbli-perusahaan.edit']);
        Permission::create(['name' => 'kbli-perusahaan.destroy']);

        //geo-location
        Permission::create(['name' => 'geo-location.index']);
        Permission::create(['name' => 'geo-location.create']);
        Permission::create(['name' => 'geo-location.edit']);
        Permission::create(['name' => 'geo-location.destroy']);

        //assign-task
        Permission::create(['name' => 'assign-approve.index']);
        Permission::create(['name' => 'assign-approve.create']);
        Permission::create(['name' => 'assign-approve.edit']);
        Permission::create(['name' => 'assign-approve.destroy']);

        Permission::create(['name' => 'keamanan.kbliperusahaan-index']);
        Permission::create(['name' => 'keamanan.assignapprove-index']);
        // // foto-kbli-perusahaan
        // Permission::create(['name' => 'foto-kbli-perusahaan.index']);
        // Permission::create(['name' => 'foto-kbli-perusahaan.create']);
        // Permission::create(['name' => 'foto-kbli-perusahaan.edit']);
        // Permission::create(['name' => 'foto-kbli-perusahaan.destroy']);

        // create roles
        $roleUser = Role::create(['name' => 'customer']);
        $roleUser->givePermissionTo([
            'visitor.index',
        ]);

        // create Super Admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        $roleAdmin = Role::create(['name' => 'employee']);
        $roleAdmin->givePermissionTo([
            'dashboard',
            'master-table.management',
            'kabupaten.index',
            'kabupaten.create',
            'kabupaten.edit',
            'kabupaten.destroy',
            'kecamatan.index',
            'kecamatan.create',
            'kecamatan.edit',
            'kecamatan.destroy',
            'kelurahan.index',
            'kelurahan.create',
            'kelurahan.edit',
            'kelurahan.destroy',
            'kbli.index',
            'kbli.create',
            'kbli.edit',
            'kbli.destroy',
            'uraian-jenis-perusahaan.index',
            'uraian-jenis-perusahaan.create',
            'uraian-jenis-perusahaan.edit',
            'uraian-jenis-perusahaan.destroy',
            'uraian-resiko-proyek.index',
            'uraian-resiko-proyek.create',
            'uraian-resiko-proyek.edit',
            'uraian-resiko-proyek.destroy',
            'uraian-skala-usaha.index',
            'uraian-skala-usaha.create',
            'uraian-skala-usaha.edit',
            'uraian-skala-usaha.destroy',
            'data-table.management',
            'profile-pengusaha.index',
            'profile-pengusaha.create',
            'profile-pengusaha.edit',
            'profile-pengusaha.destroy',
            'perusahaan.index',
            'perusahaan.create',
            'perusahaan.edit',
            'perusahaan.destroy',
            'kbli-perusahaan.index',
            'kbli-perusahaan.create',
            'kbli-perusahaan.edit',
            'kbli-perusahaan.destroy',
            'geo-location.index',
            'geo-location.create',
            'geo-location.edit',
            'geo-location.destroy',
            'assign-approve.index',
            'assign-approve.create',
            'assign-approve.edit',
            'assign-approve.destroy',
            'penugasan.management',
            'artikel.management',
            'kategori-artikel.index',
            'kategori-artikel.create',
            'kategori-artikel.edit',
            'kategori-artikel.destroy',
            'artikel.index',
            'artikel.create',
            'artikel.edit',
            'artikel.destroy',
            'visitor.index',
        ]);
       



        //assign user id 1 ke super admin
        $user = User::find(1);
        $user->assignRole('super-admin');
        $user = User::find(2);
        $user->assignRole('employee');
        $user = User::find(3);
        $user->assignRole('customer');
    }
}
