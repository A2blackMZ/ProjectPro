<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
        // Voir tous les roles
        public function index()
        {
            //Récupérer l'Administrateur actuellement authentifié
            $user = auth()->user()->id;

            // Récupérez tous les roles créés par cet admin
            $roles = Role::where("user_id", "=", $user)->get();

            return response($roles, 200);
        }

        // Récupérer un seul role
        public function show($id)
        {
            $role = Role::find($id);
            return response()->json($role);
        }


        //Création d'un role
        public function store(Request $request)
        {
            //Validation des champs
            $attrs = $request -> validate([
                'nom_role' => 'required|string',
                 //'user_id',
            ]);

            $user = auth()->user()->id;

            $role = Role::create([
                'nom_role' => $attrs['nom_role'],
                'user_id' => $user,
            ]);

            return response([
                'role' => $role
            ], 200);
        }


         //Modification d'un role
         public function update(Request $request, $id)
         {

            $role = Role::find($id);

            if(!$role)
            {
                return response([
                    'message' => 'Role inexistant'
                ], 403);
            }

            $attrs = $request -> validate([
                'nom_role' => 'required|string',
                 //'user_id',
            ]);

             $role-> update([
                'nom_role' => $attrs['nom_role'],
            ]);

            return response([
                  $role
            ], 200);
         }


         //Suppression d'un role
         public function destroy($id)
         {
            $role = Role::find($id);

            if(!$role)
            {
                return response([
                    'message' => 'Role inexistant'
                ], 403);
            }

            $role->delete();

            return response([
                'message' => 'Role supprimé',
            ], 200);
         }
}
