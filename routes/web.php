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

Route::get('/','App\Http\Controllers\PagesController@getHome' );
Route::get('/contact','App\Http\Controllers\PagesController@getContact' );
Route::post('/contact/submit', 'App\Http\Controllers\MessagesController@submit');


Route::get('/af', 'App\Http\Controllers\AgriFarmController@getagrifarm');
Route::post('/af/submit', 'App\Http\Controllers\AgriFarmController@submit');
Route::get('/nest', 'App\Http\Controllers\NestController@getnest');
Route::post('/nest/submit', 'App\Http\Controllers\NestController@submit');
Route::get('/hr', 'App\Http\Controllers\HrController@gethr');
Route::post('/hr/submit', 'App\Http\Controllers\HrController@submit');
Route::get('/avu', 'App\Http\Controllers\AVUController@getavu');
Route::post('/avu/submit', 'App\Http\Controllers\AVUController@submit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
