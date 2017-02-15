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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', 'DocumentController@index');
Route::post('/documents/search', 'DocumentController@search');
Route::get('/documents/{id}/pdf', 'DocumentController@getSinglePdf');
Route::get('/documents/{id}/dwg', 'DocumentController@getSingleDwg');
Route::post('/documents/pdf', 'DocumentController@zipManyPdf');
Route::post('/documents/dwg', 'DocumentController@zipManyDwg');

Route::get('/status/unf', 'StatusController@index');
Route::post('/status/unf/search', 'StatusController@search_UNF');
Route::get('/status/{id}/pdf', 'StatusController@getSinglePdf');

Route::get('/service', 'ServiceController@index');
Route::get('/service/rpa', 'ServiceController@rpa');
Route::get('/service/taf', 'ServiceController@taf');

Route::get('/service/exist/document/taf', 'ServiceController@existInfoUpdateForTAF');
Route::get('/service/exist/document/rpa', 'ServiceController@existInfoUpdateForRPA');
Route::get('/service/exist/document/unf', 'ServiceController@existInfoUpdateForUNF');

Route::get('/service/exist/status/unf', 'ServiceController@statusInfoUpdateForUNF');

Route::get('/service/max_rev', 'ServiceController@maxRevUpdate');

Route::get('/service/upload', 'DatabaseController@index');
Route::post('/service/upload/file', 'DatabaseController@upload');