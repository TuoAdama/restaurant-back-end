<?php

use App\Models\Plat;
use App\Models\Categorie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PlatCommandeController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\TableClientController;
use App\Models\TableClient;
use Illuminate\Support\Facades\Auth;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'onSubmit'])->name('onSubmit');
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function(){

    Route::resource('plats', PlatController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('personnels', PersonnelController::class);
    Route::resource('tableclients', TableClientController::class);

    Route::get('/plat/create', [PlatController::class, 'create'])->name('plats.register');
    Route::get('/', [HomeController::class, 'index']);
    // Route::get('/personnels', [HomeController::class, 'personnel'])->name('personnels');
    Route::get('/commandes/{id?}', [HomeController::class, 'commandes'])->name('commandes');
    Route::redirect('/','/plats');

});


Route::get('/test', function(){
    $t = TableClient::whereDate('created_at', date('Y-m-d'))->get()->toArray();
    dd($t);
});