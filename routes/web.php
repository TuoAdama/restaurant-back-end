<?php

use App\Models\Plat;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/personnels', [HomeController::class, 'personnel'])->name('personnels');
Route::get('/commandes/{id?}', [HomeController::class, 'commandes'])->name('commandes');
Route::post('/login', [LoginController::class, 'onSubmit'])->name('onSubmit');