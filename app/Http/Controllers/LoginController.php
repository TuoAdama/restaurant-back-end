<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $reques)
    {
        return view('pages.login');
    }

    public function onSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(Auth::attempt($credentials)){
            return redirect()->to('/');
        }

        return redirect()->back()->with('error', 'idenfiants incorrects');
    }
}
