<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlatController extends Controller
{
    public function save(Request $request)
    {

        //validation des données...
        $validator = Validator::make($request->all(), [
            'categorie_id' => 'required|integer|exists:App\Models\Categorie,id',
            'libelle' => 'required|string',
            'prix'=>'required|integer',
        ]);

        if($validator->fails()){
            return response($validator->errors(), 404);
        }

        $categorie = Categorie::find($request->input('categorie_id'));

        
        if($categorie == null){
            return response([
                'message' => 'categorie non trouvée',
            ], 404);
        }

        $plat = new Plat([
            'categorie_id' => $request->input('categorie_id'),
            'libelle' => $request->input('libelle'),
            'prix' => $request->input('prix')
        ]);

        $plat->save();

        return response([$plat], 201);
    }

    public function all()
    {
        $plats = Plat::with(['categorie','images'])->orderBy('libelle')->get();
        
        return response()->json($plats);
    }

    public function find($id)
    {
        $plat = Plat::find($id);

        if($plat == null){
            return response([],404);
        }

        $plat->categorie;
        $plat->plat_commandes;
        $plat->images;
        return response([
            'plat' => $plat,
        ], 200);
    }

}
