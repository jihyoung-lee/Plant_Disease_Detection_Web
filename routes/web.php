<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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
/* Main Page */
Route::view('/', 'home');

/* Admin Page */
Route::get('/admin', [AdminController::class, 'admin'])->name('admin.index')->middleware('login');
Route::match(['post','get'],'/file/{id}',[AdminController::class,'adminUpdate'])->name('admin.update');
Route::delete('/{id}', [AdminController::class, 'delete'])->name('admin.delete');

/* Classifier */
Route::get('/dashboard', [PhotoController::class, 'show'])->name('photo.index');
Route::match(['post','get'],'/photo', [PhotoController::class, 'store'])->name('photo.store');
Route::match(['post','get'],'/opinion/{id}',[AdminController::class,'opinionStore'])->name('photo.opinion');

/* Search Page */
Route::match(['post','get'],'/list/', [SearchController::class, 'index'])->name('search.index');
Route::get('/info/{cropName?}/{sickNameKor?}', [SearchController::class, 'infoIndex'])->name('info.index');

/* Auth */
Route::get('/sign', [UserController::class,'index'])->name('user.index');
Route::match(['post','get'],'/sign1',[UserController::class,'store'])->name('user.store');
Route::get('/login',[LoginController::class,'index'])->name('login.index');
Route::match(['post','get'],'/login1',[LoginController::class,'login'])->name('login.login');
Route::get('/logout',[LoginController::class,'logout'])->name('login.logout');
