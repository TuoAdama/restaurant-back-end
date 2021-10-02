<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'plat_id' => 'required|integer|exists:App\Models\Plat,id',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $path = "plats/".$request->plat_id;
        $i = 0;
        $file_name = "$i.".$request->file('image')->extension();

        while(Storage::exists("public/$path/$file_name")) {
            $file_name = (++$i).".".$request->file('image')->extension();
        }
        
        $request->file('image')->storeAs("public/$path", $file_name);

        $image = Image::create([
            'plat_id' => $request->plat_id,
            'chemin' => "$path/$file_name",
        ]);

        return response([
            'image' => $image,
        ], 201);

    }

    public function all()
    {
        return Image::all();
    }

    public function find($id)
    {
        return Image::find($id);
    }
}
