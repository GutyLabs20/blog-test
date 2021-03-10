<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;

use App\Http\Controllers\Admin\UserController;

//Agregando un middleware, que es para proteger las rutas, tambien se hara para users pero desde el controlador.
Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

//Del resource solo index, edit, update.
Route::resource('users', UserController::class)->only(['index','edit','update'])->names('admin.users');

Route::resource('roles', RoleController::class)->names('admin.roles');

//Aplicamos el metodo except para que no genere una ruta, en este caso SHOW
Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories');
Route::resource('tags', TagController::class)->except('show')->names('admin.tags');
Route::resource('posts', PostController::class)->except('show')->names('admin.posts');
