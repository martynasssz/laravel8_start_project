<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

//Category controller
Route::get('/category/all',[CategoryController::class,'AllCategory'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'AddCategory'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class,'pdelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

   // $users = User::all(); //we can get all data from user model (Eloquent ORM method)
   
   $users = DB::table('users')->get();  //get data using query bilder

    return view('dashboard', compact('users'));  //to pass all data from users use compact('users') function // pass all user data to view
})->name('dashboard');
