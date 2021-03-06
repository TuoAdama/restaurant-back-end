<?php

use App\Http\Controllers\Api\PersonnelController as ApiPersonnelController;
use App\Http\Controllers\Api\PlatCommandeController as ApiPlatCommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PlatCommandeController;
use App\Http\Controllers\TableClientController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/logout', function (Request $request) {
        return $request->user()->tokens()->delete();
    });

    Route::get('test', function () {
        return "It's work";
    });

    Route::post('/commande/save', [CommandeController::class, 'save']);
    Route::post('/categorie/save', [CategorieController::class, 'save']);
    Route::post('/tableclient/save', [TableClientController::class, 'save']);
    Route::post('/poste', [PosteController::class, 'save']);
    Route::post('/image/save', [ImageController::class, 'save']);
});

Route::post('/commande/save', [CommandeController::class, 'save']);
Route::get('/categories', [CategorieController::class, 'all']);
Route::get('/categorie/{id}', [CategorieController::class, 'find']);

Route::get('/plats', [PlatController::class, 'all']);
Route::get('/plat/{id}', [PlatController::class, 'find']);

Route::get('/search/plats/{id}/{categorie}/{count}', [PlatController::class,'search']);

Route::get('/tableclient', [TableClientController::class, 'all']);
Route::get('/tableclient/{numero_table}', [TableClientController::class, 'findByNumeroTable']);


Route::get('/poste', [PosteController::class, 'all']);
Route::get('/poste/libelle/{libelle}', [PosteController::class, 'findByLibelle']);
Route::get('/poste/id/{id}', [PosteController::class, 'findById']);

Route::get('/personnel', [ApiPersonnelController::class, 'all']);
Route::get('/personnel/save', [PersonnelController::class, 'save']);
Route::get('/personnel/{id}', [PersonnelController::class, 'find']);
//Route::get('/login', [PersonnelController::class, 'login']);

// Route::get('/commandes', [CommandeController::class, 'all']);
Route::get('/commandes/{id?}', [ApiPlatCommandeController::class, 'getCommandes']);

Route::get('/commandes/personnel/{id}/{date?}', [CommandeController::class, 'findByPersonneId']);
Route::get('/commande/table={num}/personnel={id}', [CommandeController::class, 'findByTableNum']);

Route::get('/image', [ImageController::class, 'all']);
Route::get('/image/{id}', [ImageController::class, 'find']);

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/commandes/changeEtat', [CommandeController::class, 'changeEtat']);


Route::post('/notification/token/saveOrUpdate', [PersonnelController::class, 'updateToken']);

Route::get('plats/{id}', [PlatController::class, 'destroy']);
Route::get('categories/{id}', [CategorieController::class, 'destroy']);
Route::get('/personnels/{id}', [PersonnelController::class, 'destroy']);
Route::get('/tableclients/{id}', [TableClientController::class, 'destroy']);

Route::get('/items/commandes/{id}', [CommandeController::class, 'commandeItems']);