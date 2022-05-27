<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();

        $personnel = new Personnel();
        $personnel->nom = explode(' ', $user->name)[0];
        $personnel->prenom = explode(' ', $user->name)[1];
        $personnel->user_id = $user->id;
        $personnel->user_id = $user->id;
        $personnel->poste_id = 1;
        $personnel->date_de_naissance = '1998-06-28';
        $personnel->sexe = 'M';

        $personnel->save();

        $token = $user->createToken('tuoadama')->plainTextToken;

        return response()->json([
            'personnel' => $personnel,  
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Authenfication echouée'], 401);
        }

        $user->tokens()->delete();

        return response()->json([
            'token' => $user->createToken($user->email)->plainTextToken,
            'personnel' => $user->personnel,
        ], 200);
    }
}
