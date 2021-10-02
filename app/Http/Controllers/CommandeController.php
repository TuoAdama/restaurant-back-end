<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Commande;
use App\Models\TableClient;
use App\Models\PlatCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommandeController extends Controller
{
    public function all()
    {
        return response(Commande::all(), 200);
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'num_table' => 'required|string|exists:App\Models\TableClient,numero_table',
            'personnel_id' => 'required|integer|exists:App\Models\Personnel,id',
            'commandes.*.plat_id' => 'required|integer|exists:App\Models\Plat,id'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $table_client = TableClient::where('numero_table', $request->num_table)->first();
        $id_etat = Etat::select('id')->where('libelle', 'EN COURS')->first()->id;

        $commande = new Commande([
            'table_client_id' => $table_client->id,
            'personnel_id' => $request->personnel_id,
            'etat_id' => $id_etat,
        ]);

        $commande->save();

        foreach ($request->commandes as $item) {
            PlatCommande::create([
                'commande_id' => $commande->id,
                'plat_id' => $item['plat_id'],
                'quantite' => $item['quantite'],
            ]);
        }

        $commande->etat;

        return response($commande, 201);
    }

    public function findByPersonneId($id)
    {
        $commandes = Commande::where('personnel_id', $id)->orderBy('created_at', 'desc')->get();
        if ($commandes == null) {
            return response([], 404);
        }
        foreach ($commandes as $commande) {
            $commande->table_client;
            $commande->table_client->commandes;
            $commande->etat;
        }

        return response($commandes, 200);
    }

    public function findByTableNum($num, $id)
    {

        $validator = Validator::make(['numero_table' => $num, 'personnel_id' => $id], [
            'numero_table' => 'required|string|exists:App\Models\TableClient,numero_table',
            'personnel_id' => 'required|string|exists:App\Models\Personnel,id',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 401);
        }

        $table = TableClient::where('numero_table', $num)->first();
        $commandes = Commande::where('table_client_id', $table->id)
            ->where('personnel_id', $id)
            ->first();
        $commandes->table_client;
        $commandes->table_client;
        $commandes->plat_commandes;
        $commandes->plat_commandes->map(function($plat_cmd){
            $plat_cmd->plat;
            $plat_cmd->plat->categorie;
            $plat_cmd->plat->images;
        });
        return response($commandes, 200);

        if ($table == null) {
            return response([], 404);
        }
        $table->commandes->first()->plat_commandes;

        foreach ($table->commandes->first()->plat_commandes as $cmd) {
            $cmd->plat;
            $cmd->plat->categorie;
            $cmd->plat->images;
        }

        if ($table == null) {
            return response([], 404);
        }

        return response($table->only('commandes'), 200);
    }

    public function find($id)
    {
        $commande = Commande::find($id);
        if ($commande == null) {
            return response([], 404);
        }
        $commande->plat_commandes;
        $commande->personnel;
        return response([
            'commande' => $commande,
        ], 200);
    }
}
