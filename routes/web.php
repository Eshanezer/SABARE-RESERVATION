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

Route::get('/afd', 'App\Http\Controllers\AgriDinningController@getdinning')->middleware('CustomAuth');
Route::get('/afd', 'App\Http\Controllers\AgriDinningController@dropDownShow')->middleware('CustomAuth');
Route::post('/afd/submit', 'App\Http\Controllers\AgriDinningController@submit');


Route::get('/nest', 'App\Http\Controllers\NestController@getnest')->middleware('CustomAuth');
//Route::get('/nest', 'App\Http\Controllers\NestController@dropDownShow')->middleware('CustomAuth');
Route::post('/nest/submit', 'App\Http\Controllers\NestController@submit');

Route::get('/hr', 'App\Http\Controllers\HrController@gethr')->middleware('CustomAuth');
Route::post('/hr/submit', 'App\Http\Controllers\HrController@submit');

Route::get('/avu', 'App\Http\Controllers\AVUController@getavu')->middleware('CustomAuth');
Route::get('/avu', 'App\Http\Controllers\AVUController@dropDownShow')->middleware('CustomAuth');
Route::post('/avu/submit', 'App\Http\Controllers\AVUController@submit');

// Route::get('/af', 'App\Http\Controllers\SendEmailVCController@index');
Route::post('/af/send', 'App\Http\Controllers\AgriFarmController@send');
Route::post('/hr/send', 'App\Http\Controllers\HrController@send');
Route::post('/nest/send', 'App\Http\Controllers\NestController@send');

Route::get('/admin','App\Http\Controllers\PagesController@admin' )->middleware('AdminMiddleware');
Route::get('/vc','App\Http\Controllers\PagesController@vc' )->middleware('VCMiddleware');
Route::get('/avucoordinator','App\Http\Controllers\PagesController@avucoordinator' )->middleware('AVUCoordinator');
Route::get('/nestcoordinator','App\Http\Controllers\PagesController@nestcoordinator' )->middleware('NestCoordinatorMiddleware');
Route::get('/agricoordinator','App\Http\Controllers\PagesController@agricoordinator' )->middleware('AgriFarmCoordinatorMiddleware');

Route::get('/dean_hod','App\Http\Controllers\PagesController@dean_hod' )->middleware('DeanHodMiddleware');

Route::get('/viewagribooking', 'App\Http\Controllers\SendEmailVCController@viewagribooking')->name('viewagribooking');

Route::get('/viewnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewnestbooking')->name('viewnestbooking');
Route::get('/viewvcnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewvcnestbooking')->name('viewvcnestbooking');

Route::get('show/{id}','App\Http\Controllers\ViewNestBookingController@show');
Route::post('show/{id}','App\Http\Controllers\ViewNestBookingController@vcapprove');
Route::get('/viewdeanhodnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewdeanhodnestbooking')->name('viewdeanhodnestbooking');  


Route::get('/viewagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewagridbooking')->name('viewagridbooking');
Route::get('/viewvcagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewvcagridbooking')->name('viewvcagridbooking');

Route::get('show/{id}','App\Http\Controllers\ViewAFDBookingController@show');
Route::post('show/{id}','App\Http\Controllers\ViewAFDBookingController@vcapprove');
Route::get('/viewdeanhodagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewdeanhodagridbooking')->name('viewdeanhodagridbooking');  



Route::get('/viewhrbooking', 'App\Http\Controllers\ViewHrBookingController@viewhrbooking')->name('viewhrbooking'); 
 
//Route::get('/viewavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewavubooking')->name('viewavubooking'); 

Route::get('/viewadminagribooking', 'App\Http\Controllers\AdminAgriSBookingController@viewadminagribooking')->name('viewadminagribooking'); 
Route::get('/viewadminnestbooking', 'App\Http\Controllers\AdminNestBookingController@viewadminnestbooking')->name('viewadminnestbooking'); 
Route::get('/viewadminafdbooking', 'App\Http\Controllers\AdminNestBookingController@viewadminafdbooking')->name('viewadminafdbooking'); 


Route::get('/viewadminhrbooking', 'App\Http\Controllers\AdminHrBookingController@viewadminhrbooking')->name('viewadminhrbooking'); 
Route::get('/viewavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewavubooking')->name('viewavubooking');
Route::get('/viewdeanhodavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewdeanhodavubooking')->name('viewdeanhodavubooking');  
Route::get('/viewSelectavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewSelectavubooking')->name('viewSelectavubooking'); 

Route::get('approve/{BookingId}','App\Http\Controllers\SendEmailVCController@edit');
Route::get('hrapprove/{BookingId}','App\Http\Controllers\ViewHrBookingController@edit');
Route::get('nestapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@edit');

Route::get('avuconfirm/{BookingId}','App\Http\Controllers\ViewAVUBookingController@edit');
Route::get('avunotconfirm/{BookingId}','App\Http\Controllers\ViewAVUBookingController@reject');


Route::get('avurecommend/{BookingId}','App\Http\Controllers\ViewAVUBookingController@recommend');
Route::get('avunnotrecommend/{BookingId}','App\Http\Controllers\ViewAVUBookingController@notrecommend');

Route::get('nestrecommend/{BookingId}','App\Http\Controllers\ViewNestBookingController@recommend');
Route::get('nestnotrecommend/{BookingId}','App\Http\Controllers\ViewNestBookingController@notrecommend');
Route::get('nestconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@confirm');
Route::get('nestnotconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@reject');

Route::get('nestapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@nestapprove');
Route::get('nestnotapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@nestnotapprove');
Route::get('shownestvc/{id}','App\Http\Controllers\ViewNestBookingController@shownestvc');


Route::get('afdrecommend/{BookingId}','App\Http\Controllers\ViewAFDBookingController@recommend');
Route::get('afdnotrecommend/{BookingId}','App\Http\Controllers\ViewAFDBookingController@notrecommend');
Route::get('afdconfirm/{BookingId}','App\Http\Controllers\ViewAFDBookingController@confirm');
Route::get('afdnotconfirm/{BookingId}','App\Http\Controllers\ViewAFDBookingController@reject');

Route::get('afdapprove/{BookingId}','App\Http\Controllers\ViewAFDBookingController@afdapprove');
Route::get('afdnotapprove/{BookingId}','App\Http\Controllers\ViewAFDBookingController@afdnotapprove');
Route::get('showafdvc/{id}','App\Http\Controllers\ViewAFDBookingController@showafdvc');



Route::get('/edit-records','App\Http\Controllers\UserDetailsController@index')->middleware('AdminMiddleware');;
Route::get('edit/{id}','App\Http\Controllers\UserDetailsController@show');
Route::post('edit/{id}','App\Http\Controllers\UserDetailsController@edit');
Route::get('delete/{id}','App\Http\Controllers\UserDetailsController@destroy');

Route::get('/guest-records','App\Http\Controllers\UserDetailsController@guestonly')->middleware('AdminMiddleware');
Route::get('editguest/{id}','App\Http\Controllers\UserDetailsController@showguest');
Route::post('editguest/{id}','App\Http\Controllers\UserDetailsController@editguest');

Route::get('/guest-show','App\Http\Controllers\UserDetailsController@guestshowonly');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
