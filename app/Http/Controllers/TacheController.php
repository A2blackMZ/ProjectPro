<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tache;


class TacheController extends Controller
{

    public function index()
    {
        return response()->json(Taches::all(), 200);
    }

    public function store(Request $request)
    {
        $tache = Taches::create($request->all());
        return new TacheResource($tache);
    }

    public function show($id)
    {
        $tache = Taches::findOrFail($id);
        return new TacheResource($tache);
    }

    public function update(Request $request, $id)
    {
        $tache = Taches::findOrFail($id);
        $tache->update($request->all());
        return new TacheResource($tache);
    }

    public function destroy($id)
    {
        $tache = Taches::findOrFail($id);
        $tache->delete();
        return response()->json(null, 204);
    }

}
