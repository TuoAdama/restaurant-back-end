<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Commande;
use App\Models\TableClient;
use App\Models\PlatCommande;
use Illuminate\Http\Request;
use Illuminate\Notifications\Console\NotificationTableCommand;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CommandeController extends Controller
{
    public function all()
    {
        return response(Commande::all(), 200);
    }

    public function save(Request $request)
    {
        $id_etat = Etat::select('id')->where('libelle', 'EN COURS')->first()->id;
        $personnel_id = $request->personnel_id;
        $table = TableClient::where('numero_table', $request->table)->first();

        $commande = new Commande([
            'table_client_id' => $table->id,
            'personnel_id' => $personnel_id,
            'etat_id' => $id_etat,
            'date_de_commande' => date('Y-m-d H:i:s')
        ]);

        $commande->save();

        foreach ($request->plats as $item) {
            PlatCommande::create([
                'commande_id' => $commande->id,
                'plat_id' => $item['id'],
                'quantite' => $item['quantite'],
            ]);
        }

        $commande->etat;

        return response()->json([$commande], 201);
    }

    public function findByPersonneId($id, $date = null)
    {
        $commandes = Commande::where('personnel_id', $id)
            ->with('personnel', 'etat', 'table_client')
            ->get();

        return $commandes;

        if ($date != null) {
            $commandes->whereDate('created_at', $date);
        }

        $commandes  = $commandes->get();

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
        $commandes->plat_commandes->map(function ($plat_cmd) {
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

    public function changeEtat(Request $request)
    {
        $commande = Commande::find($request->commande_id);
        $commande->etat_id = $request->etat_id;
        $table = $commande->table_client->numero_table;

        $commande->save();

        NotificationController::send($commande->personnel, $table);

        return response()->json([$commande]);
    }

    public static function commandeItems($id)
    {
        $commandes = Commande::with('table_client', 'plat_commandes.plat.images', 'plat_commandes.plat.categorie')
            ->where('id', $id)
            ->first();
        return response()->json($commandes);
    }

    public function print($id)
    {
        $data =  self::commandeItems($id)->getData(true);
        $data['date'] = Carbon::parse($data['date_de_commande'])->locale('fr')->isoFormat('lll');
        $total = 0;
        foreach ($data['plat_commandes'] as $item) {
            $total += $item['plat']['prix'] * $item['quantite'];
        }
        $pdf = Pdf::loadview('facture.facture', [
            'data' => $data,
            'total' => $total,
        ]);
        return $pdf->download('facture.pdf');
    }
}
