<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoitureRequest;
use App\Voiture;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = Voiture::latest()->get();

        return response()->json($voitures, 201);
    }

    public function store(VoitureRequest $request)
    {
        $voiture = Voiture::create($request->all());

        return response()->json($voiture, 201);
    }

    public function show($id)
    {
        $voiture = Voiture::findOrFail($id);

        return response()->json($voiture);
    }

    public function update(VoitureRequest $request, $id)
    {
        $voiture = Voiture::findOrFail($id);
        $voiture->update($request->all());

        return response()->json($voiture, 200);
    }

    public function destroy($id)
    {
        Voiture::destroy($id);

        return response()->json(null, 204);
    }
}