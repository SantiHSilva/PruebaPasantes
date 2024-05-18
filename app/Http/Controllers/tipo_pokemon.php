<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tipo_pokemon extends Controller
{
    //
    function index(){
        $tipos = \App\Models\tipo_pokemon::all();
        return view('tipo_pokemon.tipo_pokemon', compact('tipos'));
    }

    function store(Request $request){
        $data = json_decode($request->getContent(), true);
        $tipo = new \App\Models\tipo_pokemon();
        $tipo->tipo = $data['tipo'];
        $tipo->save();
        return redirect('tipo_pokemon');
    }

    function edit(Request $request, $id){
        \App\Models\tipo_pokemon::where('id', $id)->update([
            'tipo' => $request->tipo
        ]);
        return redirect('tipo_pokemon');
    }

    function delete($id){
        \App\Models\tipo_pokemon::destroy($id);
        return redirect('tipo_pokemon');
    }
}
