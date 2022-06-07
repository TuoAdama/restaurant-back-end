<?php

namespace App\Http\Controllers;

use App\Models\TableClient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TableClientController extends Controller
{
    public function index()
    {
        return view('pages.tableclients', [
            'tables' => TableClient::paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_table' => 'required|string|unique:table_clients,numero_table',
        ]);

        TableClient::create(['numero_table' => strtoupper($request->numero_table)]);

        return redirect()->back()->with('success','Table enregistrée');
    }

    public function destroy($id)
    {
        return TableClient::destroy($id);
    }

    public function all()
    {
        return TableClient::all();
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero_table' => 'required|string|unique:table_clients',
        ]);

        if($validator->fails()){
            return response($validator->errors(), 401);
        }

        $table_client = new TableClient([
            'numero_table' => $request->input('numero_table')
        ]);

        $table_client->save();
        
        return response([$table_client], 201);

    }

    public function findByNumeroTable($num)
    {
        $table = TableClient::where('numero_table', $num)->first();
        if($table == null){
            return response([], 404);
        }
        return response($table,200);
    }
}
