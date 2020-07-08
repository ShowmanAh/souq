<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('dashboard', function(){
    return view('dashboard.index');
    });

 ?>
