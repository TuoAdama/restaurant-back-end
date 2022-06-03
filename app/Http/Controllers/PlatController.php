<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Plat;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlatController extends Controller
{
    public function save(Request $request)
    {

        //validation des données...

        $request->validate([
            'categorie_id' => 'required|integer|exists:App\Models\Categorie,id',
            'libelle' => 'required|string',
            'prix' => 'required|integer',
            'images' => 'required|mimes:jpg,png,jpeg'
        ]);

        $categorie = Categorie::find($request->input('categorie_id'));


        if ($categorie == null) {
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
        $plats = Plat::with(['categorie', 'images'])->orderBy('libelle')->get();

        return response()->json($plats);
    }

    public function find($id)
    {
        $plat = Plat::find($id);

        if ($plat == null) {
            return response([], 404);
        }

        $plat->categorie;
        $plat->plat_commandes;
        $plat->images;
        return response([
            'plat' => $plat,
        ], 200);
    }

    public function index(Request $request)
    {
        $plats = Plat::with(['categorie', 'images'])
            ->orderBy('libelle')
            ->paginate(10);

        $categories = Categorie::all();

        return view('pages.plats', [
            'plats' => $plats,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'libelle' => 'required|string',
            'prix' => 'required|integer',
            'categorie_id' => 'required|integer|exists:categories,id',
            'images.*' => 'required|file|mimes:jpg,jpeg,png'
        ]);

        $plat = Plat::create($data);
        
        ImageController::save($request, $plat->id);

        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        dd('Update', $id);
    }

    public function edit(Request $request, $id)
    {
        dd('Edit', $id);
    }

    public function destroy(Request $id)
    {
        dd('destroy', $id);
    }
}
