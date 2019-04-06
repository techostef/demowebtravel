<?php

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
    return redirect(config('app.url').'/login');
});

Route::get('', function () {
    return redirect(config('app.url').'/login');
});

Route::get('/login',[
    'uses'=>'LoginController@index',
    'middleware'=>'HasLogin'
]);

// Route::get('/login','LoginController@index');

Route::get('/auth',function(){
    return redirect('/login');
});

Route::post('/auth','LoginController@auth');

Route::get('/logout','LoginController@logout');

//user  
Route::get('/user/profileku',[
    'uses'=>'user\UserController@profileku',
    'middleware'=>'CheckLogin:1'
]);


Route::post('/user/updateprofile',[
    'uses'=>'user\UserController@updateprofileku',
    'middleware'=>'CheckLogin:1'
]);

Route::post('/user/checkusername',[
    'uses'=>'user\UserController@checkusername',
    'middleware'=>'CheckLogin'
]);

Route::get('/user/checkusername',function(){
    return redirect('/home');
});

Route::get('/user/karyawan',[
    'uses'=>'user\UserController@karyawan',
    'middleware'=>'CheckLogin:list_daftar_karyawan'
]);

Route::get('/user/karyawan_level',[
    'uses'=>'user\UserController@karyawan_level',
    'middleware'=>'CheckLogin'
]);

Route::get('/user/karyawan_level_restore',[
    'uses'=>'user\UserController@karyawan_level_restore',
    'middleware'=>'CheckLogin'
]);

Route::get('/user/karyawan_restore',[
    'uses'=>'user\UserController@karyawan_restore',
    'middleware'=>'CheckLogin:list_restore_karyawan'
]);

Route::get('/user/restore/{id}',[
    'uses'=>'user\UserController@restore',
    'middleware'=>'CheckLogin:restore_restore_karyawan'
]);

Route::get('/user/delete_permanent/{id}',[
    'uses'=>'user\UserController@delete_permanent',
    'middleware'=>'CheckLogin:restore_delete_karyawan'
]);

Route::get('/user_level/restore/{id}',[
    'uses'=>'user\UserController@user_level_restore',
    'middleware'=>'CheckLogin'
]);

Route::get('/user_level/delete_permanent/{id}',[
    'uses'=>'user\UserController@user_level_delete_permanent',
    'middleware'=>'CheckLogin'
]);

Route::get('/user_level/permission/{id}',[
    'uses'=>'user\UserController@permission',
    'middleware'=>'CheckLogin'
]);

Route::post('/user/permission_update',[
    'uses'=>'user\UserController@permission_update',
    'middleware'=>'CheckLogin'
]);


Route::get('/user_level/tambah',[
    'uses'=>'user\UserController@user_level_tambah',
    'middleware'=>'CheckLogin'
]);

Route::get('/user_level/insertdata',function(){
    return redirect('/home');
});

Route::post('/user_level/insertdata',[
    'uses'=>'user\UserController@user_level_insertdata',
    'middleware'=>'CheckLogin'
]);


Route::post('/user_level/updatetdata',[
    'uses'=>'user\UserController@user_level_updatedata',
    'middleware'=>'CheckLogin'
]);

Route::get('/user_level/edit/{id}',[
    'uses'=>'user\UserController@user_level_edit',
    'middleware'=>'CheckLogin:120'
]);


Route::get('/user_level/delete/{id}',[
    'uses'=>'user\UserController@user_level_delete',
    'middleware'=>'CheckLogin'
]);

Route::get('/history',[
    'uses'=>'HistoryController@index'
]);


Route::get('/user/tambah',[
    'uses'=>'user\UserController@tambah',
    'middleware'=>'CheckLogin:tambah_daftar_karyawan'
]);

Route::get('/user/view/{id}',[
    'uses'=>'user\UserController@view',
    'middleware'=>'CheckLogin:lihat_daftar_karyawan'
]);

Route::get('/user/insertdata',function(){
    return redirect('/home');
});

Route::post('/user/insertdata',[
    'uses'=>'user\UserController@insertdata',
    'middleware'=>'CheckLogin:tambah_daftar_karyawan'
]);

Route::get('/user/edit/{id}',[
    'uses'=>'user\UserController@edit',
    'middleware'=>'CheckLogin:ubah_daftar_karyawan'
]);

Route::post('/user/updatedata',[
    'uses'=>'user\UserController@updatedata',
    'middleware'=>'CheckLogin:ubah_daftar_karyawan'
]);

Route::get('/user/delete/{id}',[
    'uses'=>'user\UserController@delete',
    'middleware'=>'CheckLogin:hapus_daftar_karyawan'
]);








