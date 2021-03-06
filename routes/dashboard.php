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
######### end language route #########

#### MainCategoryRoute ###########
Route::group(['prefix' => '/maincategories'], function () {
    Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
    Route::get('/create', 'MainCategoriesController@create')->name('admin.maincategories.create');
    Route::post('/store', 'MainCategoriesController@store')->name('admin.maincategories.store');
    Route::get('/edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
    Route::post('/updated/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
    Route::get('/delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.destroy');
    Route::get('/changestaues/{id}', 'MainCategoriesController@changeStatus')->name('admin.maincategories.changeStatus');
});
#### end MainCategory Route ###########

#### Vendors Route ###########
Route::group(['prefix' => '/vendors'], function () {
    Route::get('/', 'VendorsController@index')->name('admin.vendors');
    Route::get('/create', 'VendorsController@create')->name('admin.vendors.create');
    Route::post('/store', 'VendorsController@store')->name('admin.vendors.store');
    Route::get('/edit/{id}', 'VendorsController@edit')->name('admin.vendors.edit');
    Route::post('/updated/{id}', 'VendorsController@update')->name('admin.vendors.update');
    Route::get('/delete/{id}', 'VendorsController@destroy')->name('admin.vendors.destroy');
    Route::get('/changestaues/{id}', 'VendorsController@changeStatus')->name('admin.vendors.changeStatus');
});
#### end Vendors Route ###########

});
### route quest ###
  Route::group(['namespace'=> 'Dashboard', 'middleware'=> 'guest:admin'], function () {
     Route::get('login', 'LoginController@login');
     Route::post('login', 'LoginController@Postlogin')->name('admin.login');//admin login
  });
 ?>
