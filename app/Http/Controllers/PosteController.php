<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PosteController extends Controller
{
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|unique:postes'
        ]);

        if($validator->fails()){
            return response($validator->errors(), 404);
        }

        $poste = new Poste([
            'libelle'=>strtoupper($request->input('libelle'))
        ]);

        $poste->save();
        return response($poste, 201);
    }

    public function findById($id)
    {
        $poste = Poste::find($id);
        if($poste == null){
            return response([],404);
        }
        return response($poste, 200);
    }

    public function findByLibelle($libelle)
    {
        $poste = Poste::where('libelle',$libelle)->first();
        if($poste == null){
            return response([],404);
        }
        return response($poste, 200);
    }

    public function all()
    {
        return response(Poste::all(),200);
    }
}
