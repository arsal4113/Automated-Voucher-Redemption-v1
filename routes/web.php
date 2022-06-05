<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


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
Route::get('/getallservices','HomeController@getallservices')->name('service.getallservices');
Route::get('/getalloffers','HomeController@getalloffers')->name('service.getalloffers');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    // Dashboard route
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');

    //Voucher-CSV
    Route::get('/voucher/csvfile','CsvFile@index')->name('voucher');
    Route::post('voucher/csv_file/import','CsvFile@csv_import')->name('import');

    //Product-CSV

    Route::get('/productitem/csvfile','ProductItems@index')->name('productitem');
    Route::post('productitem/csv_file/import','ProductItems@csvimport')->name('import.productitem');

    //Service-
    Route::get('/service','ServicesController@index')->name('service.index');
    Route::get('/service/create','ServicesController@create')->name('service.create');
    Route::post('/service/store','ServicesController@store')->name('service.store');
    Route::get('/service/edit/{id}','ServicesController@edit')->name('service.edit');
    Route::post('/service/update/{id}','ServicesController@update')->name('service.update');
    Route::get('/service/delete/{id}','ServicesController@delete')->name('service.delete');

    //Service-Codes
    Route::get('/servicecode','ServiceCodeController@index')->name('servicecode.index');
    Route::get('/servicecode/create','ServiceCodeController@create')->name('servicecode.create');
    Route::post('/servicecode/store','ServiceCodeController@store')->name('servicecode.store');
    Route::get('/servicecode/edit/{id}','ServiceCodeController@edit')->name('servicecode.edit');
    Route::post('/servicecode/update/{id}','ServiceCodeController@update')->name('servicecode.update');
    Route::get('/servicecode/delete/{id}','ServiceCodeController@delete')->name('servicecode.delete');

    //offerings
    Route::get('/offers','OffersController@index')->name('offers.index');
    Route::get('/offers/create','OffersController@create')->name('offers.create');
    Route::post('/offers/store','OffersController@store')->name('offers.store');
    Route::get('/offers/edit/{id}','OffersController@edit')->name('offers.edit');
    Route::post('/offers/update/{id}','OffersController@update')->name('offers.update');
    Route::get('/offers/delete/{id}','OffersController@delete')->name('offers.delete');

});
