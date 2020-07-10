<?php

use Illuminate\Support\Facades\Route;
define('paginate_number', 10);

Auth::routes();
### route auth admin ###
Route::group(['namespace'=> 'Dashboard', 'middleware'=> 'auth:admin'], function (){
##################  dashboard route ####################

    Route::get('/', 'DashboardController@index')->name('dashboard.index');


    ########### route languages #######
    Route::group(['prefix' => '/languages'], function () {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('/create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('/store', 'LanguagesController@store')->name('admin.languages.store');
        Route::get('/edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('/updated/{id}', 'LanguagesController@update')->name('admin.languages.update');
        Route::get('/delete/{id}', 'LanguagesController@destroy')->name('admin.languages.destroy');
    });


});
### route quest ###
  Route::group(['namespace'=> 'Dashboard', 'middleware'=> 'guest:admin'], function () {
     Route::get('login', 'LoginController@login');
     Route::post('login', 'LoginController@Postlogin')->name('admin.login');//admin login
  });
 ?>
