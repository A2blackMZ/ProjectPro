<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;

class ProjetController extends Controller
{

    //Get all projects
    public function index()
    {
        //Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user()->id;

        // Récupérez tous les projets associés à cet Utilisateur
        $projets = Projet::where("user_id", "=", $user)->get();

        return response($projets, 200);
    }

    //Get single project
    public function show($id)
    {
        $projet = Projet::find($id);
        return response()->json($projet);
    }


    //Création d'un projet
    public function store(Request $request)
    {
        //Validation des champs
        $attrs = $request -> validate([
            'nom_projet' => 'required|string',
            'budget_alloue' => 'required|integer',
            'budget_depense' => 'required|integer',
            'objectif' => 'required|string',
            'risques' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin_prevue' => 'required|date',
            'jour_compte_rendu' => 'required|date'
             //'user_id',
        ]);

        //$membre = Membre::findOrFail($attrs['membre_id']);
        $user = auth()->user()->id;

        $projet = Projet::create([
            'nom_projet' => $attrs['nom_projet'],
            'user_id' => $user,
            'budget_alloue' => intval($attrs['budget_alloue']),
            'budget_depense' => intval($attrs['budget_depense']),
            'objectif' => $attrs['prix_achat'],
            'risques' => $attrs['risques'],
            'date_debut' => $attrs['date_debut'],
            'date_fin_prevue' => $attrs['date_fin_prevue'],
            'jour_compte_rendu' => $attrs['jour_compte_rendu'],
            //'stockage' => $stockage,
            //'membres_associés' => $membres,
        ]);

        return response([
            'projet' => $projet
        ], 200);
    }


     //Modification d'un projet
     public function update(Request $request, $id)
     {

        $projet = Projet::find($id);

        if(!$projet)
        {
            return response([
                'message' => 'Projet non retrouvé'
            ], 403);
        }

        $attrs = $request -> validate([
            'nom_projet' => 'required|string',
            'budget_alloue' => 'required|integer',
            'budget_depense' => 'required|integer',
            'objectif' => 'required|string',
            'risques' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin_prevue' => 'required|date',
            'jour_compte_rendu' => 'required|date'
             //'user_id',
        ]);

         $projet-> update([
            'nom_projet' => $attrs['nom_projet'],
            'budget_alloue' => $attrs['budget_alloue'],
            'budget_depense' => $attrs['budget_depense'],
            'objectif' => $attrs['prix_achat'],
            'risques' => $attrs['risques'],
            'date_debut' => $attrs['date_debut'],
            'date_fin_prevue' => $attrs['date_fin_prevue'],
            'jour_compte_rendu' => $attrs['jour_compte_rendu']
        ]);

        return response([
              $projet
        ], 200);
     }


     //Suppression d'un projet
     public function destroy($id)
     {
        $projet = Projet::find($id);

        if(!$Projet)
        {
            return response([
                'message' => 'Projet non trouvé'
            ], 403);
        }

        $projet->delete();

        return response([
            'message' => 'Projet supprimé',
        ], 200);
     }

}



