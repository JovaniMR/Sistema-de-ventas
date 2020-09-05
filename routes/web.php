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



Route::get('/{optional?}', function () {
    return view('app');
})->name('base');

//Users Routes
Route::get('/usuarios/busca','administracion\UsersController@getBuscaUsuario');
Route::get('/usuarios/obtener','administracion\UsersController@getUserById');
Route::put('/usuarios/estado/{id}','administracion\UsersController@cambiarEstado');
Route::resource('/usuarios','administracion\UsersController');

//Files
Route::get('/files/busca','administracion\FilesController@buscaFoto');
Route::resource('/files','administracion\FilesController');

//Roles

Route::get('/roles/busca','administracion\RolesController@getBuscaRoles');
Route::get('/roles/obtener','administracion\RolesController@getRolById');
Route::get('/roles/permisos','administracion\RolesController@getListarPermisosByRol');
Route::get('/roles/getPermisos','administracion\RolesController@getPermisosByRol');
Route::get('/roles/getRolAndPermissions','administracion\RolesController@getRolAndPermissions');
Route::resource('/roles','administracion\RolesController');

//Permisos

Route::get('/permisos/busca','administracion\PermissionsController@getBuscaPermisos');
Route::get('/permisos/buscaId','administracion\PermissionsController@getBuscaPermisoById');
Route::resource('/permisos','administracion\PermissionsController');





