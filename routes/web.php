<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\A_login;
use App\Http\Controllers\A_dashboard;
use App\Http\Controllers\A_admin;
use App\Http\Controllers\A_menu;
use App\Http\Controllers\A_group;
use App\Http\Controllers\A_setting;
use App\Http\Controllers\A_klub;
use App\Http\Controllers\A_skor;

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
// Route::get('/', function () {
//     return 'Homepage';
// });
Route::resource('/', A_login::class);
Route::post('admin/login', [A_login::class, 'login']);

Route::group(['middleware' => 'admin_session'], function() {
	Route::resource('admin_dashboard', A_dashboard::class);
	
	Route::resource('list_admin', A_admin::class);
	Route::post('list_admin/hapus', [A_admin::class, 'hapus']);
	Route::post('list_admin/aktifkan', [A_admin::class, 'aktifkan']);
	Route::post('list_admin/non_aktifkan', [A_admin::class, 'non_aktifkan']);

	Route::resource('group_admin', A_group::class);
	Route::post('group_admin/hapus', [A_group::class, 'hapus']);
	Route::get('group_admin/akses/{parameter}', [A_group::class, 'akses']);
	Route::get('group_admin/sub_akses/{parameter}/{id}', [A_group::class, 'sub_akses']);
	Route::post('group_admin/update_akses', [A_group::class, 'update_akses']);

	Route::resource('menu_admin', A_menu::class);
	Route::post('menu_admin/hapus', [A_menu::class, 'hapus']);
	Route::post('menu_admin/rel_menu', [A_menu::class, 'rel_menu']);

	Route::resource('setting_admin', A_setting::class); 

	Route::resource('admin_klub', A_klub::class);
	Route::post('admin_klub/hapus', [A_klub::class, 'hapus']);
    Route::get('autocomplete_kota', [A_klub::class, 'autocomplete_kota']);
    Route::post('autocomplete_kota_id', [A_klub::class, 'autocomplete_kota_id']);

	Route::resource('admin_skor', A_skor::class);
	// Route::post('list_car/hapus', [A_car::class, 'hapus']);
	// Route::post('list_car/merek', [A_car::class, 'merek']);
	// Route::post('list_car/sewa', [A_car::class, 'sewa']);

	// Route::resource('list_rent', A_rent::class);
	// Route::post('list_rent/kembalikan', [A_rent::class, 'kembalikan']);

	Route::get('admin_logout', [A_login::class, 'logout']);
});
