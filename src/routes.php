<?php
Route::group(['middleware' => 'web', 'namespace' => 'Helderwmarcos\Interbits\Controllers', 'prefix' => 'interbits'], function () {
    Route::get('/', ['as' => 'interbits_path', 'uses' => 'InterbitsUsuarioController@index']);

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'InterbitsUsuarioController@index');
        Route::post('filtrar', 'InterbitsUsuarioController@search');
        Route::get('editar/{id?}', 'InterbitsUsuarioController@edit');
        Route::post('salvar', 'InterbitsUsuarioController@save');
        Route::get('editar_senha/{id}', 'InterbitsUsuarioController@edit_password');
        Route::post('salvar_senha', 'InterbitsUsuarioController@save_password');
        Route::get('remover/{id?}', 'InterbitsUsuarioController@delete');
    });

    Route::group(['prefix' => 'funcoes'], function () {
        Route::get('/', 'InterbitsCargoController@index');
        Route::post('filtrar', 'InterbitsCargoController@search');
        Route::get('editar/{id?}', 'InterbitsCargoController@edit');
        Route::post('salvar', 'InterbitsCargoController@save');
        Route::get('remover/{id?}', 'InterbitsCargoController@delete');
    });

});