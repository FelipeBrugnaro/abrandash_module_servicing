<?php

use Illuminate\Support\Facades\Route;
use Modules\Servicing\app\Http\Controllers\ServicingController;

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

Route::middleware(['auth.admin', 'page.permission'])->group(function() {

    Route::get('/', 'ServicingController@index')->name('index');
    Route::get('/create', 'ServicingController@create')->name('create');
    Route::get('/edit/{servicing}', 'ServicingController@edit')->name('edit');

    Route::post('/create', 'ServicingController@store')->name('store');
    Route::put('/edit/{servicing}', 'ServicingController@update')->name('update');
    Route::delete('/delete/{servicing}', 'ServicingController@destroy')->name('destroy');
    
});