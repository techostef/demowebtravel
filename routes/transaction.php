<?php

Route::get('/transaction',[
    'uses'=>'transactionController@daftar',
    'middleware'=>'CheckLogin:list_daftar_transaction_order'
]);

Route::get('/transaction/index',[
    'uses'=>'transactionController@daftar',
    'middleware'=>'CheckLogin:list_daftar_transaction_order'
]);

Route::get('/transaction/list',[
    'uses'=>'transactionController@list',
    'middleware'=>'CheckLogin:list_daftar_transaction_order'
]);

Route::get('/transaction/daftar',[
    'uses'=>'transactionController@daftar',
    'middleware'=>'CheckLogin:list_daftar_transaction_order'
]);

Route::get('/transaction_restore',[
    'uses'=>'transactionController@daftar_restore',
    'middleware'=>'CheckLogin:list_restore_transaction_order'
]);

Route::get('/transaction/tambah',[
    'uses'=>'transactionController@tambah',
    'middleware'=>'CheckLogin:tambah_daftar_transaction_order'
]);

Route::get('/transaction/view/{id}',[
    'uses'=>'transactionController@view',
    'middleware'=>'CheckLogin:lihat_daftar_transaction_order'
]);

Route::get('/transaction/edit/{id}',[
    'uses'=>'transactionController@edit',
    'middleware'=>'CheckLogin:ubah_daftar_transaction_order'
]);

Route::get('/transaction/empty',[
    'uses'=>'transactionController@empty',
    'middleware'=>'CheckLogin:1'
]);

Route::post('/transaction/insertdata',[
    'uses'=>'transactionController@insertdata',
    'middleware'=>'CheckLogin:tambah_daftar_transaction_order'
]);

Route::post('/transaction/updatedata',[
    'uses'=>'transactionController@updatedata',
    'middleware'=>'CheckLogin:ubah_daftar_transaction_order'
]);

Route::get('/transaction/delete/{id}',[
    'uses'=>'transactionController@delete',
    'middleware'=>'CheckLogin:hapus_daftar_transaction_order'
]);

Route::get('/transaction/restore/{id}',[
    'uses'=>'transactionController@restore',
    'middleware'=>'CheckLogin:restore_restore_transaction_order'
]);

Route::get('/transaction/delete_permanent/{id}',[
    'uses'=>'transactionController@delete_permanent',
    'middleware'=>'CheckLogin:restore_delete_transaction_order'
]);

