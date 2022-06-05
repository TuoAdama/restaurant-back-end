<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    public function all()
    {
        return response(Categorie::select()->orderBy('libelle')->get(),200);
    }

    public function save(Request $request)
    {   

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string|unique:categories'
        ]);

        if($validator->fails()){
            return response($validator->errors(), 404);
        }

        $categorie = new Categorie();
        $categorie->libelle =  $request->input('libelle');
        $categorie->save();

        return response($categorie, 201);
    }

    public function find($id)
    {
        $categorie = Categorie::find($id);
        if($categorie == null){
            return response([], 404);
        }
        return response($categorie, 200);
    }

    public function index()
    {
        return view('pages.categories',[
            'categories' => Categorie::paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|unique:categories,libelle',
        ]);
        Categorie::create(['libelle' => trim($request->libelle)]);
        return redirect()->back()->with('success','Catégorie enregistrée');
    }

    public function destroy($id)
    {
        return Categorie::destroy($id);
    }
}