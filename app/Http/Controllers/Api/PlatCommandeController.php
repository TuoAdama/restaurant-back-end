<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PlatCommandeController as ControllersPlatCommandeController;
use App\Http\Controllers\PlatController;
use Illuminate\Http\Request;

class PlatCommandeController extends Controller
{
    public function getCommandes($id = null)
    {
        $plats = ControllersPlatCommandeController::getCommandes($id);

        return response()->json($plats);
    }
}
