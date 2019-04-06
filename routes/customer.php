<?php

Route::get('/customer',[
    'uses'=>'customerController@daftar',
    'middleware'=>'CheckLogin:list_daftar_customer'
]);

Route::get('/customer/index',[
    'uses'=>'customerController@daftar',
    'middleware'=>'CheckLogin:lihat_daftar_customer'
]);

Route::get('/customer/list',[
    'uses'=>'customerController@list',
    'middleware'=>'CheckLogin:lihat_daftar_customer'
]);

Route::get('/customer/daftar',[
    'uses'=>'customerController@daftar',
    'middleware'=>'CheckLogin:lihat_daftar_customer'
]);

Route::get('/customer_restore',[
    'uses'=>'customerController@daftar_restore',
    'middleware'=>'CheckLogin:list_restore_customer'
]);

Route::post('/customer/getinfo',[
    'uses'=>'customerController@getinfo',
    'middleware'=>'CheckLogin:lihat_daftar_customer'
]);

Route::get('/customer/tambah',[
    'uses'=>'customerController@tambah',
    'middleware'=>'CheckLogin:tambah_daftar_customer'
]);

Route::get('/customer/edit/{id}',[
    'uses'=>'customerController@edit',
    'middleware'=>'CheckLogin:ubah_daftar_customer'
]);

Route::get('/customer/view/{id}',[
    'uses'=>'customerController@view',
    'middleware'=>'CheckLogin:lihat_daftar_customer'
]);

Route::get('/customer/empty',[
    'uses'=>'customerController@empty',
    'middleware'=>'CheckLogin:1'
]);

Route::post('/customer/insertdata',[
    'uses'=>'customerController@insertdata',
    'middleware'=>'CheckLogin:tambah_daftar_customer'
]);

Route::post('/customer/updatedata',[
    'uses'=>'customerController@updatedata',
    'middleware'=>'CheckLogin:ubah_daftar_customer'
]);

Route::get('/customer/delete/{id}',[
    'uses'=>'customerController@delete',
    'middleware'=>'CheckLogin:hapus_daftar_customer'
]);

Route::get('/customer/restore/{id}',[
    'uses'=>'customerController@restore',
    'middleware'=>'CheckLogin:restore_restore_customer'
]);

Route::get('/customer/delete_permanent/{id}',[
    'uses'=>'customerController@delete_permanent',
    'middleware'=>'CheckLogin:restore_delete_customer'
]);

