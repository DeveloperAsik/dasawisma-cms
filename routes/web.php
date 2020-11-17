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

Route::post('/auth', 'Backend\Settings\UserController@auth')->name('auth');

Route::get('/dashboard', 'Backend\Settings\UserController@dashboard')->name('dashboard');
/*
 * login & logout routes start here
 */

Route::get('/login', 'Backend\Settings\UserController@login')->name('login');
Route::get('/logout', 'Backend\Settings\UserController@logout')->name('logout');

/*
 * login & logout routes end here
 */


Route::get('/prefferences/menu/get-icons', 'Backend\Prefferences\MenuController@get_icon')->name('get-icon');

Route::get('/api-docs', 'Backend\Settings\ApiDocsController@view')->name('api-docs');
Route::get('/settings', 'Backend\Settings\SettingsController@list')->name('setting');

Route::get('/prefferences/menu/view', 'Backend\Prefferences\MenuController@view')->name('view-menu');
Route::get('/prefferences/menu/get-list', 'Backend\Prefferences\MenuController@get_list')->name('get-list-menu');
Route::get('/prefferences/menu/get-data', 'Backend\Prefferences\MenuController@get_data')->name('get-data-menu');
Route::post('/prefferences/menu/insert', 'Backend\Prefferences\MenuController@insert')->name('insert-menu');
Route::post('/prefferences/menu/update', 'Backend\Prefferences\MenuController@update')->name('update-menu');
Route::post('/prefferences/menu/update-status', 'Backend\Prefferences\MenuController@update_status')->name('update-status-menu');
Route::post('/prefferences/menu/remove', 'Backend\Prefferences\MenuController@remove')->name('remove-menu');
Route::delete('/prefferences/menu/delete', 'Backend\Prefferences\MenuController@delete')->name('delete-menu');

//permission
Route::get('/settings/permission/view', 'Backend\Settings\PermissionController@view')->name('view-permission');
Route::get('/settings/permission/get-list', 'Backend\Settings\PermissionController@get_list')->name('get-list-permission');
Route::get('/settings/permission/get-data', 'Backend\Settings\PermissionController@get_data')->name('get-data-permission');
Route::post('/settings/permission/insert', 'Backend\Settings\PermissionController@insert')->name('insert-permission');
Route::post('/settings/permission/update', 'Backend\Settings\PermissionController@update')->name('update-permission');
Route::post('/settings/permission/update-status', 'Backend\Settings\PermissionController@update_status')->name('update_status-permission');
Route::post('/settings/permission/remove', 'Backend\Settings\PermissionController@remove')->name('remove-permission');
Route::delete('/settings/permission/delete', 'Backend\Settings\PermissionController@delete')->name('delete-permission');

//country
Route::get('/location/country/view', 'Backend\Master\CountryController@view')->name('view-country');
Route::post('/location/country/get-list', 'Backend\Master\CountryController@get_list')->name('get-list-country');
Route::post('/location/country/insert', 'Backend\Master\CountryController@insert')->name('insert-country');
Route::get('/location/country/get-data', 'Backend\Master\CountryController@get_data')->name('get-data-country');
Route::post('/location/country/update', 'Backend\Master\CountryController@update')->name('update-country');
Route::post('/location/country/update-status', 'Backend\Master\CountryController@update_status')->name('update_status-country');
Route::post('/location/country/remove', 'Backend\Master\CountryController@remove')->name('remove-country');
Route::delete('/location/country/delete', 'Backend\Master\CountryController@delete')->name('delete-country');

//province
Route::get('/location/province/view', 'Backend\Master\ProvinceController@view')->name('view-province');
Route::get('/location/province/get-list', 'Backend\Master\ProvinceController@get_list')->name('get-list-province');
Route::get('/location/province/get-data', 'Backend\Master\ProvinceController@get_data')->name('get-data-province');
Route::post('/location/province/insert', 'Backend\Master\ProvinceController@insert')->name('insert-province');
Route::post('/location/province/update', 'Backend\Master\ProvinceController@update')->name('update-province');
Route::post('/location/province/update-status', 'Backend\Master\ProvinceController@update_status')->name('update_status-province');
Route::post('/location/province/remove', 'Backend\Master\ProvinceController@remove')->name('remove-province');
Route::delete('/location/province/delete', 'Backend\Master\ProvinceController@delete')->name('delete-province');

//district
Route::get('/location/district/view', 'Backend\Master\DistrictController@view')->name('view-district');
Route::get('/location/district/get-list', 'Backend\Master\DistrictController@get_list')->name('get-list-district');
Route::post('/location/district/insert', 'Backend\Master\DistrictController@insert')->name('insert-district');
Route::get('/location/district/get-data', 'Backend\Master\DistrictController@get_data')->name('get-data-district');
Route::post('/location/district/update', 'Backend\Master\DistrictController@update')->name('update-district');
Route::post('/location/district/update-status', 'Backend\Master\DistrictController@update_status')->name('update_status-district');
Route::post('/location/district/remove', 'Backend\Master\DistrictController@remove')->name('remove-district');
Route::delete('/location/district/delete', 'Backend\Master\DistrictController@delete')->name('delete-district');

//sub-district
Route::get('/location/sub-district/view', 'Backend\Master\SubDistrictController@view')->name('view-sub-district');
Route::get('/location/sub-district/get-list', 'Backend\Master\SubDistrictController@get_list')->name('get-list-sub-district');
Route::get('/location/sub-district/get-data', 'Backend\Master\SubDistrictController@get_data')->name('get-data-sub-district');
Route::post('/location/sub-district/insert', 'Backend\Master\SubDistrictController@insert')->name('insert-sub-district');
Route::post('/location/sub-district/update', 'Backend\Master\SubDistrictController@update')->name('update-sub-district');
Route::post('/location/sub-district/update-status', 'Backend\Master\SubDistrictController@update_status')->name('update_status-sub-district');
Route::post('/location/sub-district/remove', 'Backend\Master\SubDistrictController@remove')->name('remove-sub-district');
Route::delete('/location/sub-district/delete', 'Backend\Master\SubDistrictController@delete')->name('delete-sub-district');

//area
Route::get('/location/area/view', 'Backend\Master\AreaController@view')->name('view-area');
Route::post('/location/area/get-list', 'Backend\Master\AreaController@get_list')->name('get-list-area');
Route::post('/location/area/get-data', 'Backend\Master\AreaController@get_data')->name('get-data-area');
Route::put('/location/area/insert', 'Backend\Master\AreaController@insert')->name('insert-area');
Route::post('/location/area/update', 'Backend\Master\AreaController@update')->name('update-area');
Route::post('/location/area/update-status', 'Backend\Master\AreaController@update_status')->name('update_status-area');
Route::post('/location/area/remove', 'Backend\Master\AreaController@remove')->name('remove-area');
Route::delete('/location/area/delete', 'Backend\Master\AreaController@delete')->name('delete-area');

//citizen
Route::get('/master/family/view', 'Backend\Master\FamilyController@view')->name('view-family');
Route::post('/master/family/get-list', 'Backend\Master\FamilyController@get_list')->name('get-list-family');
Route::post('/master/family/get-data', 'Backend\Master\FamilyController@get_data')->name('get-data-family');
Route::put('/master/family/insert', 'Backend\Master\FamilyController@insert')->name('insert-family');
Route::post('/master/family/update', 'Backend\Master\FamilyController@update')->name('update-family');
Route::post('/master/family/update-status', 'Backend\Master\FamilyController@update_status')->name('update_status-family');
Route::post('/master/family/remove', 'Backend\Master\FamilyController@remove')->name('remove-family');
Route::delete('/master/family/delete', 'Backend\Master\FamilyController@delete')->name('delete-family');


Route::get('/posts/content/create', 'Backend\Master\PostController@create')->name('create-posts');
Route::get('/posts/content/view', 'Backend\Master\PostController@view')->name('view-posts');
Route::post('/posts/content/get-list', 'Backend\Master\PostController@get_list')->name('get-list-posts');
Route::post('/posts/content/get-data', 'Backend\Master\PostController@get_data')->name('get-data-posts');
Route::put('/posts/content/insert', 'Backend\Master\PostController@insert')->name('insert-posts');
Route::post('/posts/content/update', 'Backend\Master\PostController@update')->name('update-posts');
Route::post('/posts/content/update-status', 'Backend\Master\PostController@update_status')->name('update_status-posts');
Route::post('/posts/content/remove', 'Backend\Master\PostController@remove')->name('remove-posts');
Route::delete('/posts/content/delete', 'Backend\Master\PostController@delete')->name('delete-posts');
Route::get('/posts/content/archives', 'Backend\Master\PostController@archives')->name('view-posts-archives');

Route::get('/master/volunteer/view', 'Backend\Master\VolunteerController@view')->name('view-volunteer');
Route::post('/master/volunteer/get-list', 'Backend\Master\VolunteerController@get_list')->name('get-list-volunteer');
Route::post('/master/volunteer/get-data', 'Backend\Master\VolunteerController@get_data')->name('get-data-volunteer');
Route::put('/master/volunteer/insert', 'Backend\Master\VolunteerController@insert')->name('insert-volunteer');
Route::post('/master/volunteer/update', 'Backend\Master\VolunteerController@update')->name('update-volunteer');
Route::post('/master/volunteer/update-status', 'Backend\Master\VolunteerController@update_status')->name('update_status-volunteer');
Route::post('/master/volunteer/remove', 'Backend\Master\VolunteerController@remove')->name('remove-volunteer');
Route::delete('/master/volunteer/delete', 'Backend\Master\VolunteerController@delete')->name('delete-volunteer');


Route::get('/master/property/view', 'Backend\Master\PropertyController@view')->name('view-volunteer');
Route::post('/master/property/get-list', 'Backend\Master\PropertyController@get_list')->name('get-list-property');
Route::post('/master/property/get-data', 'Backend\Master\PropertyController@get_data')->name('get-data-property');
Route::put('/master/property/insert', 'Backend\Master\PropertyController@insert')->name('insert-property');
Route::post('/master/property/update', 'Backend\Master\PropertyController@update')->name('update-property');
Route::post('/master/property/update-status', 'Backend\Master\PropertyController@update_status')->name('update_status-property');
Route::post('/master/property/remove', 'Backend\Master\PropertyController@remove')->name('remove-property');
Route::delete('/master/property/delete', 'Backend\Master\PropertyController@delete')->name('delete-volunteer');
