<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['namespace'=> 'Dashboard', 'middleware'=> 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});
  Route::group(['namespace'=> 'Dashboard', 'middleware'=> 'guest:admin'], function () {
     Route::get('login', 'LoginController@login');
     Route::post('login', 'LoginController@Postlogin')->name('dashboard.login');
  });
 ?>
