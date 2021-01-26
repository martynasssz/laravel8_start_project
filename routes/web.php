<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is home page";
});

// Route::get('/about', function () {
//     return view('about');
// })->middleware('check');  //use middleware

Route::get('/about', function () {
     return view('about');
});
//Route::get('/contact', 'ContactController@index');  //after @ we write method we want to create //laravel 6 ard 7 writing format

Route::get('/contact-sdsdsdsdd-dsdd',[ContactController::class,'index'])->name('con'); //laravel 8 format  // addedd for route name  //profesional way to use


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
