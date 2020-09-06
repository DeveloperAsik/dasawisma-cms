<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'Backend\Settings\UserController@login')->name('backend');

Route::post('/save-token', 'Backend\Settings\UserController@save_token')->name('save-token');
/*
 * login & logout routes start here
 */

Route::get('/login', 'Backend\Settings\UserController@login')->name('login');
Route::get('/logout', 'Backend\Settings\UserController@logout')->name('logout');

/*
 * login & logout routes end here
 */

Route::get('/api-docs', 'Backend\Settings\ApiDocsController@view')->name('api-docs');
Route::get('/settings', 'Backend\Settings\SettingsController@list')->name('setting');

Route::get('/prefferences/menu/view', 'Backend\Prefferences\MenuController@view')->name('view-menu');
Route::post('/prefferences/menu/get-list', 'Backend\Prefferences\MenuController@get_list')->name('get-list-menu');
Route::post('/prefferences/menu/get-data', 'Backend\Master\CountryController@get_data')->name('get-data-menu');
Route::put('/prefferences/menu/insert', 'Backend\Prefferences\MenuController@insert')->name('insert-menu');
Route::post('/prefferences/menu/update', 'Backend\Prefferences\MenuController@update')->name('update-menu');
Route::post('/prefferences/menu/update-status', 'Backend\Prefferences\MenuController@update_status')->name('update-status-menu');
Route::post('/prefferences/menu/remove', 'Backend\Prefferences\MenuController@remove')->name('remove-menu');
Route::delete('/prefferences/menu/delete', 'Backend\Prefferences\MenuController@delete')->name('delete-menu');

//permission
Route::get('/settings/permission/view', 'Backend\Settings\PermissionController@view')->name('view');
Route::post('/settings/permission/get-list', 'Backend\Settings\PermissionController@get_list')->name('get-list');
Route::post('/settings/permission/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::put('/settings/permission/insert', 'Backend\Settings\PermissionController@insert')->name('insert');
Route::post('/settings/permission/update', 'Backend\Settings\PermissionController@update')->name('update');
Route::post('/settings/permission/update-status', 'Backend\Settings\PermissionController@update_status')->name('update_status');
Route::post('/settings/permission/remove', 'Backend\Settings\PermissionController@remove')->name('remove');
Route::delete('/settings/permission/delete', 'Backend\Settings\PermissionController@delete')->name('delete');

//country
Route::get('/location/country/view', 'Backend\Master\CountryController@view')->name('view');
Route::post('/location/country/get-list', 'Backend\Master\CountryController@get_list')->name('get-list');
Route::put('/location/country/insert', 'Backend\Master\CountryController@insert')->name('insert');
Route::post('/location/country/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::post('/location/country/update', 'Backend\Master\CountryController@update')->name('update');
Route::post('/location/country/update-status', 'Backend\Master\CountryController@update_status')->name('update_status');
Route::post('/location/country/remove', 'Backend\Master\CountryController@remove')->name('remove');
Route::delete('/location/country/delete', 'Backend\Master\CountryController@delete')->name('delete');

//province
Route::get('/location/province/view', 'Backend\Master\ProvinceController@view')->name('view');
Route::post('/location/province/get-list', 'Backend\Master\ProvinceController@get_list')->name('get-list');
Route::post('/location/province/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::put('/location/province/insert', 'Backend\Master\ProvinceController@insert')->name('insert');
Route::post('/location/province/update', 'Backend\Master\ProvinceController@update')->name('update');
Route::post('/location/province/update-status', 'Backend\Master\CountryController@update_status')->name('update_status');
Route::post('/location/province/remove', 'Backend\Master\CountryController@remove')->name('remove');
Route::delete('/location/province/delete', 'Backend\Master\ProvinceController@delete')->name('delete');

//district
Route::get('/location/district/view', 'Backend\Master\DistrictController@view')->name('view');
Route::post('/location/district/get-list', 'Backend\Master\DistrictController@get_list')->name('get-list');
Route::put('/location/district/insert', 'Backend\Master\DistrictController@insert')->name('insert');
Route::post('/location/district/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::post('/location/district/update', 'Backend\Master\DistrictController@update')->name('update');
Route::post('/location/district/update-status', 'Backend\Master\CountryController@update_status')->name('update_status');
Route::post('/location/district/remove', 'Backend\Master\CountryController@remove')->name('remove');
Route::delete('/location/district/delete', 'Backend\Master\DistrictController@delete')->name('delete');

//sub-district
Route::get('/location/sub-district/view', 'Backend\Master\SubDistrictController@view')->name('view');
Route::post('/location/sub-district/get-list', 'Backend\Master\SubDistrictController@get_list')->name('get-list');
Route::post('/location/sub-district/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::put('/location/sub-district/insert', 'Backend\Master\SubDistrictController@insert')->name('insert');
Route::post('/location/sub-district/update', 'Backend\Master\SubDistrictController@update')->name('update');
Route::post('/location/sub-district/update-status', 'Backend\Master\CountryController@update_status')->name('update_status');
Route::post('/location/sub-district/remove', 'Backend\Master\CountryController@remove')->name('remove');
Route::delete('/location/sub-district/delete', 'Backend\Master\SubDistrictController@delete')->name('delete');

//area
Route::get('/location/area/view', 'Backend\Master\AreaController@view')->name('view');
Route::post('/location/area/get-list', 'Backend\Master\AreaController@get_list')->name('get-list');
Route::post('/location/area/get-data', 'Backend\Master\CountryController@get_data')->name('get-data');
Route::put('/location/area/insert', 'Backend\Master\AreaController@insert')->name('insert');
Route::post('/location/area/update', 'Backend\Master\AreaController@update')->name('update');
Route::post('/location/area/update-status', 'Backend\Master\CountryController@update_status')->name('update_status');
Route::post('/location/area/remove', 'Backend\Master\CountryController@remove')->name('remove');
Route::delete('/location/area/delete', 'Backend\Master\AreaController@delete')->name('delete');
