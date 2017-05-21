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
    return view('welcome');
});

Route::get('/', 'TempatController@index');
Route::get('/tempat', 'TempatController@index');
Route::post('/tempat/kategori/store', 'KategoriController@store');
Route::get('/tempat/create', 'TempatController@create');
Route::post('/tempat/store', 'TempatController@store');
Route::get('/tempat/edit/{id}', 'TempatController@edit');
Route::post('/tempat/update/{id}', 'TempatController@update');
Route::get('/tempat/delete/{id}', 'TempatController@destroy');

//----------------------------------------------------------\
//----------- API ------------------------------------------\
//----------------------------------------------------------\
Route::get('api/tempat','Api\TempatController@index');
Route::get('api/tempat/{id}','Api\TempatController@kategori');
Route::get('api/kategori/','Api\KategoriController@index');
