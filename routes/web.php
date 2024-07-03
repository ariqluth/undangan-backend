<?php

use App\Http\Controllers\AssignApproveController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\KbliPerusahaanController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProfilePengusahaController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\UraianJenisPerusahaanController;
use App\Http\Controllers\UraianResikoProyekController;
use App\Http\Controllers\UraianSkalaUsahaController;
use App\Http\Controllers\KategoriArtikelController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SecurityControler;
use App\Http\Controllers\UndanganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorArtikelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/show-artikel', [VisitorArtikelController::class, 'show'])->name('visitor.show');
Route::get('/show-map', [VisitorController::class, 'mapvisitor'])->name('visitor.mapvisitor');
Route::get('/show-artikel-detail/{visitor:slug}', [VisitorArtikelController::class, 'detail'])->name('visitor.detail');

Route::get('/undangan/{undangan_id}/', [UndanganController::class, 'utama'])->name('undangan.utama');
// Route::get('/', [VisitorController::class, 'index'])->middleware('permission.or.visitor:visitor.index');


Route::get('/', [VisitorController::class, 'utama'])->name('visitor.utama');
Route::get('/api/company/{id}', [VisitorController::class, 'fetchCompanyData'])->name('fetchCompanyData');


Route::group(['middleware' => ['auth', 'verified', 'role:mobile|super-admin|artikel|admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.edit');
});

Route::group(['middleware' => ['auth', 'verified', 'role:user|super-admin|artikel|admin']], function () {
    Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
});

Route::group(['middleware' => ['auth', 'verified', 'role:artikel|super-admin|admin']], function () {
    Route::prefix('artikel-management')->group(function () {
        //Artikel
        Route::post('artikel/import', [ArtikelController::class, 'import'])->name('artikel.import');
        Route::get('artikel/export', [ArtikelController::class, 'export'])->name('artikel.export');
        Route::get('/artikel/index', [ArtikelController::class, 'index'])->name('artikel');
        Route::get('/artikel/search', [ArtikelController::class, 'search'])->name('artikel.search');
        Route::resource('artikel', ArtikelController::class);

        Route::get('/kategori-artikel/index', [KategoriArtikelController::class, 'index'])->name('kategori-artikel');
        Route::post('kategori-artikel/import', [KategoriArtikelController::class, 'import'])->name('kategori-artikel.import');
        Route::get('kategori-artikel/export', [KategoriArtikelController::class, 'export'])->name('kategori-artikel.export');
        Route::resource('kategori-artikel', KategoriArtikelController::class);
    });
});

Route::group(['middleware' => ['auth', 'verified', 'role:super-admin|admin']], function () {

    Route::prefix('master-table-management')->group(function () {
        // kabupaten
        Route::post('kabupaten/import', [KabupatenController::class, 'import'])->name('kabupaten.import');
        Route::get('kabupaten/export', [KabupatenController::class, 'export'])->name('kabupaten.export');
        Route::resource('kabupaten', KabupatenController::class);

        // kecamatan
        Route::post('kecamatan/import', [KecamatanController::class, 'import'])->name('kecamatan.import');
        Route::get('kecamatan/export', [KecamatanController::class, 'export'])->name('kecamatan.export');
        Route::resource('kecamatan', KecamatanController::class);

        // Kelurahan
        Route::post('kelurahan/import', [KelurahanController::class, 'import'])->name('kelurahan.import');
        Route::get('kelurahan/export', [KelurahanController::class, 'export'])->name('kelurahan.export');
        Route::resource('kelurahan', KelurahanController::class);
        Route::post('kecamatan-filter', [KelurahanController::class, 'kecamatanFilter'])
            ->name('kecamatan.filters');
        Route::get('edkecamatan-filter', [KelurahanController::class, 'kecamataneditFilter'])
            ->name('editkecamatan.filters');


        // kbli
        Route::post('kbli/import', [KbliController::class, 'import'])->name('kbli.import');
        Route::get('kbli/export', [KbliController::class, 'export'])->name('kbli.export');
        Route::resource('kbli', KbliController::class);


        //uraian jenis perusahaan
        Route::post('uraian-jenis-perusahaan/import', [UraianJenisPerusahaanController::class, 'import'])
            ->name('uraian.jenis.perusahaan.import');
        Route::get('uraian-jenis-perusahaan/export', [UraianJenisPerusahaanController::class, 'export'])
            ->name('uraian.jenis.perusahaan.export');
        Route::resource('uraian-jenis-perusahaan', UraianJenisPerusahaanController::class);

        //uraian resiko proyek
        Route::post('uraian-resiko-proyek/import', [UraianResikoProyekController::class, 'import'])
            ->name('uraian.resiko.proyek.import');
        Route::get('uraian-resiko-proyek/export', [UraianResikoProyekController::class, 'export'])
            ->name('uraian.resiko.proyek.export');
        Route::resource('uraian-resiko-proyek', UraianResikoProyekController::class);

        //uraian skala usaha
        Route::post('uraian-skala-usaha/import', [UraianSkalaUsahaController::class, 'import'])
            ->name('uraian.skala.usaha.import');
        Route::get('uraian-skala-usaha/export', [UraianSkalaUsahaController::class, 'export'])
            ->name('uraian.skala.usaha.export');
        Route::resource('uraian-skala-usaha', UraianSkalaUsahaController::class);
    });


    Route::prefix('data-table-management')->group(function () {
        //profile-pengusaha
        Route::post('profile-pengusaha/import', [ProfilePengusahaController::class, 'import'])
            ->name('profile.pengusaha.import');
        Route::get('profile-pengusaha/export', [ProfilePengusahaController::class, 'export'])
            ->name('profile.pengusaha.export');
        Route::resource('profile-pengusaha', ProfilePengusahaController::class);

        //perusahaan
        Route::post('kelurahan-filter', [PerusahaanController::class, 'kelurahanFilter'])
            ->name('kelurahan.filter');
        Route::post('kecamatan-filter', [PerusahaanController::class, 'kecamatanFilter'])
            ->name('kecamatan.filter');
        Route::get('edit-kelurahan-filter', [PerusahaanController::class, 'editLoadKelurahan'])
            ->name('load.filter');
        Route::get('edit-kecamatan-filter', [PerusahaanController::class, 'editLoadkecamatan'])
            ->name('loadK.filter');
        Route::post('perusahaan/import', [PerusahaanController::class, 'import'])
            ->name('perusahaan.import');
        Route::get('perusahaan/export', [PerusahaanController::class, 'export'])
            ->name('perusahaan.export');
        Route::resource('perusahaan', PerusahaanController::class);



        //kbli-perusahaan
        Route::get('edit-kelurahan-filter', [KbliPerusahaanController::class, 'editLoadKelurahan'])
            ->name('load.filter');
        Route::post('/kelurahan-filter', [KbliPerusahaanController::class, 'kelurahanFilter'])
            ->name('kelurahan.filter');
        Route::post('kbli-filter', [KbliPerusahaanController::class, 'kbliFilter'])
            ->name('kbli.filter');
        Route::get('edit-filter', [KbliPerusahaanController::class, 'editFilter'])
            ->name('edit.filter');
        Route::post('kbli-perusahaan/import', [KbliPerusahaanController::class, 'import'])
            ->name('kbli.perusahaan.import');
        Route::get('kbli-perusahaan/export', [KbliPerusahaanController::class, 'export'])
            ->name('kbli.perusahaan.export');
        Route::post('/set-selected-kbli-id', [KbliPerusahaanController::class, 'setSelectedKbliId'])
            ->name('set-selected-kbli-id');
        Route::post('clear-selected-kbli-id', [KbliPerusahaanController::class, 'clearSelectedKbliId'])
            ->name('clear-selected-kbli-id');
        Route::post('kelurahanstore-filter', [KbliPerusahaanController::class, 'kelurahanStoreFilter'])
            ->name('kelurahanstore.filter');
        Route::post('/submit-form', [KbliPerusahaanController::class, 'submitForm'])
            ->name('page-1');
        Route::resource('kbli-perusahaan', KbliPerusahaanController::class);

        //geo-localtion
        Route::resource('geo-location', GeoLocationController::class);
        Route::post('/kelurahan-filter', [GeoLocationController::class, 'kelurahanFilters'])
            ->name('kelurahan.filter');
    });

    Route::prefix('penugasan-management')->group(function () {
        Route::post('kbliperusahaanfilter-filter', [AssignApproveController::class, 'kbliperusahaanfilter'])
            ->name('kbliperusahaanfilter.filter');
        Route::get('kbliperusahaanfiltered-filter', [AssignApproveController::class, 'kbliperusahaanfiltered'])
            ->name('kbliperusahaanfiltered.filter');
        Route::resource('assign-approve', AssignApproveController::class);
        Route::match(['get', 'post'], 'assign-approve/{id}/approve', [AssignApproveController::class, 'approve'])
            ->name('assign-approve.approve');
        Route::post('/assign-approve/unapprove/{id}', [AssignApproveController::class, 'unapprove'])
            ->name('assign-approve.unapprove');
        Route::post('/assign-approve/reject/{id}', [AssignApproveController::class, 'reject'])
            ->name('assign-approve.reject');
    });
});
Route::group(['middleware' => ['auth', 'verified', 'role:super-admin']], function () {

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::match(['get', 'post'], '/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])
            ->name('user.verify-email');
        Route::delete('/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])
            ->name('user.delete-verify-email');
        Route::post('import', [UserController::class, 'import'])->name('user.import');
        Route::get('export', [UserController::class, 'export'])->name('user.export');
        Route::get('demo', DemoController::class)->name('user.demo');
    });

    Route::prefix('security-management')->group(function () {
        Route::get('/assign-approve-security', [SecurityControler::class, 'assignApprove'])->name('assignApprove.index');
        Route::get('/kbli-perusahaan-security', [SecurityControler::class, 'kbliPerusahaan'])->name('kbliPerusahaan.index');
    });


    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::post('menu-group/{id}/move-up', [MenuGroupController::class, 'moveUp'])
            ->name('menu-group.move-up');
        Route::post('menu-group/{id}/move-down', [MenuGroupController::class, 'moveDown'])
            ->name('menu-group.move-down');
        Route::resource('menu-item', MenuItemController::class);
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::get('role/export', ExportRoleController::class)->name('role.export');
        Route::post('role/import', ImportRoleController::class)->name('role.import');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
        Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });
});
