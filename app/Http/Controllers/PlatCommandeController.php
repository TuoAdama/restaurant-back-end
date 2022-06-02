<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\PlatCommande;
use Illuminate\Http\Request;

class PlatCommandeController extends Controller
{
    public static function getCommandes($id = null)
    {
        $plats = PlatCommande::with(['plat' => function ($element) {
            $element->with('images', 'categorie');
        }], 'commande')
        ->orderBy('created_at', 'desc')->get();

        if ($id) {
            $commandeIds = Commande::where('personnel_id', $id)
                    ->get()->pluck('id')->toArray();
            $plats = PlatCommande::whereIn('commande_id', $commandeIds)
                ->with(['plat' => function ($p) {
                    $p->with('images', 'categorie');
                }, 'commande' => function ($cmd) {
                    $cmd->with('table_client', 'etat');
                }])
                ->orderBy('created_at', 'desc')->get();
        }

        return $plats;
    }
}
