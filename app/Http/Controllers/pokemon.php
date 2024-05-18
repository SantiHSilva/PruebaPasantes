<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pokemon extends Controller
{
    public function index()
    {
        $pokemones = \App\Models\pokemon::all();
        $tipos = \App\Models\tipo_pokemon::all();
        return view('pokemon.pokemon', compact('pokemones', 'tipos'));
    }

    public function store(Request $request){
        // se envia un json, se debe convertir a array
        $data = json_decode($request->getContent(), true);
        echo $data['name'];

        // se crea un nuevo pokemon
        $pokemon = new \App\Models\pokemon();
        $pokemon->name = $data['name'];
        $pokemon->tipo1 = $data['tipo1'];
        $pokemon->tipo2 = $data['tipo2'];
        $pokemon->save();

        return redirect('pokemon');
    }

    public function edit(Request $request, $id){
        \App\Models\pokemon::where('id', $id)->update([
            'name' => $request->name,
            'tipo1' => $request->tipo1,
            'tipo2' => $request->tipo2
        ]);
        return redirect('pokemon');
    }

    public function delete($id){
        \App\Models\pokemon::destroy($id);
        return redirect('pokemon');
    }

}
