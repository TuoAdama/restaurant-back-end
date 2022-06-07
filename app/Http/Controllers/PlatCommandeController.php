<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\PlatCommande;
use Illuminate\Http\Request;

class PlatCommandeController extends Controller
{
    public static function getCommandes($id = null, $date = null)
    {
        $commandes = Commande::with(['table_client', 'personnel', 'etat', 'plat_commandes' => function($q){
            $q->with('plat');
        }]);

        if($id){
            $commandes = $commandes->where('personnel_id', $id);
        }

        if($date){
            $commandes = $commandes->whereDate('date_de_commande', $date);
        }

        $commandes = $commandes->orderBy('created_at', 'desc')->get();

        // $plats = PlatCommande::with(['plat' => function ($p) {
        //     $p->with('images', 'categorie');
        // }, 'commande' => function ($cmd) {
        //     $cmd->with('table_client', 'etat');
        // }]);


        // if ($id) {
        //     $commandeIds = Commande::where('personnel_id', $id)
        //         ->get()->pluck('id')->toArray();


        //     $plats = $plats->whereIn('commande_id', $commandeIds);
        // }

        // if ($date == "today") {
        //     $plats = $plats->whereDate('created_at', date('Y-m-d'));
        // }

        // $plats = $plats->orderBy('created_at', 'desc')->get();

        return $commandes;
    }
}
