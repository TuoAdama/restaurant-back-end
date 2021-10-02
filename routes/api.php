<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\TableClientController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categorie', [CategorieController::class, 'all']);
Route::get('/categorie/{id}', [CategorieController::class, 'find']);
Route::post('/categorie/save', [CategorieController::class, 'save']);

Route::get('/plat', [PlatController::class, 'all']);
Route::get('/plat/{id}', [PlatController::class, 'find']);
Route::post('/plat/save', [PlatController::class, 'save']);

Route::get('/tableclient', [TableClientController::class, 'all']);
Route::get('/tableclient/{numero_table}', [TableClientController::class, 'findByNumeroTable']);
Route::post('/tableclient/save', [TableClientController::class, 'save']);


Route::get('/poste', [PosteController::class, 'all']);
Route::get('/poste/libelle/{libelle}', [PosteController::class, 'findByLibelle']);
Route::post('/poste/id/{id}', [PosteController::class, 'findById']);
Route::post('/poste', [PosteController::class, 'save']);

Route::get('/personnel', [PersonnelController::class, 'all']);
Route::get('/personnel/save', [PersonnelController::class, 'save']);
Route::get('/personnel/{id}', [PersonnelController::class, 'find']);
Route::get('/login', [PersonnelController::class, 'login']);

Route::get('/commande', [CommandeController::class, 'all']);
Route::get('/commande/{id}', [CommandeController::class, 'find']);
Route::post('/commande/save', [CommandeController::class, 'save']);
Route::get('/commande/personnel/{id}', [CommandeController::class, 'findByPersonneId']);
Route::get('/commande/table={num}/personnel={id}', [CommandeController::class, 'findByTableNum']);

Route::get('/image', [ImageController::class, 'all']);
Route::post('/image/save', [ImageController::class, 'save']);
Route::get('/image/{id}', [ImageController::class, 'find']);

Route::post('/test', function(Illuminate\Http\Request $request){
    return $request->commandes;
});