<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompteRendu;

class CompteRenduController extends Controller
{

    //Get all compte rendu
    public function index()
    {
        //Récupérer l'utilisateur actuellement authentifié
        $user = auth()->user()->id;

        // Récupérez tous les compte rendus associés à cet Utilisateur
        $compte_rendus = CompteRendu::where("user_id", "=", $user)->get();

        return response($compte_rendus, 200);
    }

    //Get single compte_rendu
    public function show($id)
    {
        $compte_rendu = CompteRendu::find($id);
        return response()->json($compte_rendu);
    }


    //Création d'un compte rendu
    public function store(Request $request)
    {
        //Validation des champs
        $attrs = $request -> validate([
            'evenement' => 'required|string',
            'difficultes' => 'required|integer',
            'commentaires' => 'required|integer',
            'date' => 'required|string',
            'approche_solution' => 'required|string',
            'action_retenu' => 'required|date',
             //'user_id',
        ]);

        //$membre = Membre::findOrFail($attrs['membre_id']);
        $user = auth()->user()->id;

        $projet = Projet::create([
            'evenement' => $attrs['evenement'],
            'user_id' => $user,
            'difficultes' => $attrs['difficultes'],
            'commentaires' => $attrs['commentaires'],
            'date' => $attrs['date'],
            'approche_solution' => $attrs['approche_solution'],
            'action_retenu' => $attrs['action_retenu'],
            //'stockage' => $stockage,
            //'membres_associés' => $membres,
        ]);

        return response([
            'compte_rendu' => $compte_rendu
        ], 200);
    }


     //Modification d'un compte rendu
     public function update(Request $request, $id)
     {

        $compte_rendu = CompteRendu::find($id);

        if(!$compte_rendu)
        {
            return response([
                'message' => 'Compte rendu non retrouvé'
            ], 403);
        }

        $attrs = $request -> validate([
            'evenement' => 'required|string',
            'difficultes' => 'required|integer',
            'commentaires' => 'required|integer',
            'date' => 'required|string',
            'approche_solution' => 'required|string',
            'action_retenu' => 'required|date',
             //'user_id',
        ]);

         $projet-> update([
            'evenement' => $attrs['evenement'],
            'user_id' => $user,
            'difficultes' => $attrs['difficultes'],
            'commentaires' => $attrs['commentaires'],
            'date' => $attrs['date'],
            'approche_solution' => $attrs['approche_solution'],
            'action_retenu' => $attrs['action_retenu'],
            //'stockage' => $stockage,
            //'membres_associés' => $membres,
        ]);

        return response([
              $compte_rendu
        ], 200);
     }


     //Suppression d'un compte rendu
     public function destroy($id)
     {
        $compte_rendu = CompteRendu::find($id);

        if(!$compte_rendu)
        {
            return response([
                'message' => ' Compte Rendu non trouvé'
            ], 403);
        }

        $projet->delete();

        return response([
            'message' => ' Compte Rendu supprimé',
        ], 200);
     }

}
