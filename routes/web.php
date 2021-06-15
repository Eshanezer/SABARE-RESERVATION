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

// Route::group(['middleware'=>"web"],function(){

// });

Route::get('/','App\Http\Controllers\PagesController@getHome' );
Route::get('/contact','App\Http\Controllers\PagesController@getContact' )->middleware('CustomAuth');
Route::post('/contact/submit', 'App\Http\Controllers\MessagesController@submit');


Route::get('/af', 'App\Http\Controllers\AgriFarmController@getagrifarm')->middleware('CustomAuth');
Route::post('/af/submit', 'App\Http\Controllers\AgriFarmController@submit');
Route::get('/nest', 'App\Http\Controllers\NestController@getnest')->middleware('CustomAuth');
Route::post('/nest/submit', 'App\Http\Controllers\NestController@submit');
Route::get('/hr', 'App\Http\Controllers\HrController@gethr')->middleware('CustomAuth');
Route::post('/hr/submit', 'App\Http\Controllers\HrController@submit');
Route::get('/avu', 'App\Http\Controllers\AVUController@getavu')->middleware('CustomAuth');
Route::post('/avu/submit', 'App\Http\Controllers\AVUController@submit');

// Route::get('/af', 'App\Http\Controllers\SendEmailVCController@index');
Route::post('/af/send', 'App\Http\Controllers\AgriFarmController@send');
Route::post('/hr/send', 'App\Http\Controllers\HrController@send');
Route::post('/nest/send', 'App\Http\Controllers\NestController@send');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
