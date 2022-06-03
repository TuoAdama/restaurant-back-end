<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public static function save(Request $request, $plat_id)
    {

        foreach ($request->file('images') as $file) {
            $path = "plats/" . $plat_id;
            $i = 0;
            $file_name = "$i." . $file->extension();

            while (Storage::exists("public/$path/$file_name")) {
                $file_name = (++$i) . "." . $file->extension();
            }

            $file->storeAs("public/$path", $file_name);

            $image = Image::create([
                'plat_id' => $plat_id,
                'chemin' => "$path/$file_name",
            ]);
        }

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
