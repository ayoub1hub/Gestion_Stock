<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
 // identique a require_once

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',[PostController::class , 'index'])->name('posts.index'); // creation of short cut to the index route

Route::get('/posts/create' ,[PostController::class , 'create'])->name('posts.create');

Route::post('/posts' ,[PostController::class , 'store'])->name('posts.store');

Route::get('/posts/{posts}/edit' , [PostController::class , 'edit'])->name('posts.edit');

Route::get('/posts/{post}/' , [ PostController::class , 'show'])->name('posts.show');//everything between brackets is considered as a dynamic parameter

Route::put('/posts/{post}' , [PostController::class , 'update'])->name('posts.update');

Route::delete('/posts/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');


// 1 - define a new route so the user can access it trought browser : done
// 2 - define controller that renders view : done
// 3 - define view that contains list of posts : done
// 4 - remove any static html data from the view : done


// 1- structure change for database (create table , edit column , remove column)
// 2- operations on database (insert record , edit record , delete record)