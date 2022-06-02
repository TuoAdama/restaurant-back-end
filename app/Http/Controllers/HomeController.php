<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function personnel()
    {
        return view('pages.personnels', [
            'personnels' => PersonnelController::all()
        ]);
    }

    public function commandes(Request $request, $id = null)
    {
        $commandes = PlatCommandeController::getCommandes($id);

        return view('pages.commande', ['commandes' => $commandes]);
    }
}
