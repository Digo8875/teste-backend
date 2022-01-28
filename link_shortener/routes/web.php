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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get_link/{slug}', 'LinkController@getLinkBySlug')->name('get_link');

//Route Group for Logged Users
Route::middleware('auth')->group(function() {

    Route::resource('links', 'LinkController');

    Route::post('/import_links', 'LinkController@importLinks')->name('import_links');
    Route::get('/export_links', 'LinkController@exportLinks')->name('export_links');
});
