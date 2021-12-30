<?php

use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassifierController;
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
Route::match(['post','get'],'/Classifier', [ClassifierController::class, 'store'])->name('Classifier.index');

/* Disease list */
Route::match(['post','get'],'/list/', [DiseaseController::class, 'index'])->name('list.index');
Route::get('/info/{cropName?}/{sickNameKor?}', [DiseaseController::class, 'info'])->name('info.index');
