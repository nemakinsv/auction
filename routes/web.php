<?php

use App\Http\Middleware\AuctionAccess;
use App\Http\Middleware\LotAccess;
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

Route::group(['middleware' => LotAccess::class], function () {
    Route::get('/lot/add', 'LotController@createForm')->name('lot.add');
    Route::post('/lot/store', 'LotController@store')->name('lot.store');
    Route::get('/lot/index', 'LotController@index')->name('lot.index');
    Route::get('/lot/edit/{id}', 'LotController@updateForm')->name('lot.edit')->where('id', '[0-9]+');
    Route::post('/lot/update/{id}', 'LotController@update')->name('lot.update')->where('id', '[0-9]+');
    Route::get('/lot/destroy/{id}/', 'LotController@destroy')->name('lot.destroy')->where('id', '[0-9]+');
    Route::get('/auction/start/{id}', 'AuctionController@start')->name('auction.start')->where('id', '[0-9]+');
});
Route::group(['middleware' => AuctionAccess::class], function () {
    Route::get('/auction/refresh/{id}', 'AuctionController@refresh')->name('auction.refresh')->where('id', '[0-9]+');;
    Route::get('/auction/index', 'AuctionController@index')->name('auction.index');
    Route::post('/auction/offer/{id}', 'AuctionController@offer')->name('auction.offer')->where('id', '[0-9]+');
});
