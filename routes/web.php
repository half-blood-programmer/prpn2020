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
})->name('welcome');

Auth::routes();
//Auth::routes(['verify' => true]); kl mau verification

Route::get('/home', 'HomeController@index')->name('home'); //->middleware('verified');

## LOMBA
Route::get('/kdpn', 'lombaController@kdpn')->name('kdpn'); //middleware for all
Route::get('/hstc', 'lombaController@hstc')->name('hstc'); //middleware for all
Route::get('/3mt', 'lombaController@mt')->name('3mt'); //middleware for all
Route::get('/tacap', 'lombaController@kdpn')->name('tacap'); //middleware for all
Route::get('/suct', 'lombaController@kdpn')->name('suct'); //middleware for all
## END LOMBA

Route::get('/kdpn', 'lombaController@kdpn')->name('kdpn'); //middleware for all
Route::get('/hstc', 'lombaController@hstc')->name('hstc'); //middleware for all
Route::get('/3mt', 'lombaController@mt')->name('3mt'); //middleware for all
Route::get('/tacap', 'lombaController@tacap')->name('tacap'); //middleware for all
Route::get('/suct', 'lombaController@suct')->name('suct'); //middleware for all

Route::post('/save-data-kdpn', 'KdpnController@savedatakdpn')->name('save_data_kdpn');
Route::post('/save-trans-kdpn', 'KdpnController@savetranskdpn')->name('save_trans_kdpn');

Route::post('/save-data-tmt', 'TmtController@savedatatmt')->name('save_data_tmt');
Route::post('/save-creation-tmt', 'TmtController@savecreationtmt')->name('save_creation_tmt');

Route::post('/save-data-hstc', 'HstcController@savedatahstc')->name('save_data_hstc');
Route::post('/save-trans-hstc', 'HstcController@savetranshstc')->name('save_trans_hstc');

Route::post('/save-data-suct', 'SuctController@savedatasuct')->name('save_data_suct');
Route::post('/save-trans-suct', 'SuctController@savetranssuct')->name('save_trans_suct');

Route::post('/save-data-tacap', 'TacapController@savedatatacap')->name('save_data_tacap');
Route::post('/save-creation-tacap', 'TacapController@savecreationtacap')->name('save_creation_tacap');

Route::post('/submit-akun', 'KdpnController@submitakun')->name('submit_akun');
