<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');

//Route::get('/contact', 'ContactController@index');  //after @ we write method we want to create //laravel 6 ard 7 writing format

Route::get('/contact',[ContactController::class,'index']); //laravel 8 format

