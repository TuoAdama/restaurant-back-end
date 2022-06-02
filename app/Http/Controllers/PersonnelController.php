<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PersonnelController extends Controller
{
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poste_id' => 'required|integer|exists:App\Models\Poste,id',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_de_naissance' => [
                'required',
                'date_format:Y-m-d'
            ],
            'sexe' => [
                'required',
                Rule::in(['M', 'F'])
            ],
        ]);

        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $personnel = new Personnel([
            'poste_id' => $request->input('poste_id'),
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'date_de_naissance' => $request->input('date_de_naissance'),
            'sexe' => $request->input('sexe'),
        ]);

        $personnel->save();

        return response($personnel, 201);
    }

    public function find($id)
    {
       $personnel = Personnel::find($id);
       if($personnel == null){
           return response([], 400);
       }
       $personnel->poste;
       return response([
           'personnel' => $personnel
       ],200);
    }

    public function login(Request $request)
    {
        $validator = Validator::validate($request,[
            'email' => 'required|email',
            'password' => 'required|password_confirmation',
        ]);
    }

    public function updateToken(Request $request)
    {
        $id = $request->get('id');
        $token = $request->get('token');

        $personnel = Personnel::find($id);

        $personnel->notification_token = $token;
        $personnel->save();
        
        return response()->json([$personnel]);
    }

    public static function all()
    {
        return Personnel::with('user')->get();
    }
}
