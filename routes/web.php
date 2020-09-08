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

Route::get('/{any}', function () {
    return view('welcome');
})->where("any", ".*");



//category controller
Route::resource('/category', 'CategoryController');

//author 
Route::resource('/author', 'AuthorController');

//post
Route::resource('/admin/post', 'PostController');

Auth::routes(['register' => false]);

