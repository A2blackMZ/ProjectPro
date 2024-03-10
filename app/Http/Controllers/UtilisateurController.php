<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;

class UtilisateurController extends Controller
{
    // Enrégistrer un utilisateur
    public function enregistrer(Request $request)
    {
        // Validation des champs
        $attrs = $request->validate([
            'nom_utilisateur' => 'required|string',
            'prenom_utilisateur' => 'required|string',
            'email_utilisateur' => 'required|email|unique:utilisateurs,email_utilisateur',
            'mot_de_passe' => 'required|min:6|confirmed',
            'telephone_utilisateur' => 'required|numeric',
            'role_id' => 'required|exists:roles,id'
        ]);

        // Créer l'utilisateur
        $user = Utilisateur::create([
            'nom_utilisateur' => $attrs['nom_utilisateur'],
            'prenom_utilisateur' => $attrs['prenom_utilisateur'],
            'email_utilisateur' => $attrs['email_utilisateur'],
            'mot_de_passe' => bcrypt($attrs['mot_de_passe']),
            'telephone_utilisateur' => $attrs['telephone_utilisateur'],
        ]);

        // Attacher le rôle à l'utilisateur créé
        $user->roles()->attach($attrs['role_id']);

        // Retourner l'utilisateur & et un token dans la réponse
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
        ]);
    }

    //Connexion de l'utilisateur
    public function connexion(Request $request)
    {
        // Valider les champs
        $attrs = $request->validate([
            'email_utilisateur' => 'required|email',
            'mot_de_passe' => 'required|min:6',
        ]);

        // Essayer de le connecter
        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.',
            ], 403);
        }

        // Succès : Retourner l'utilisateur & son token dans la réponse
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken,
        ], 200);
    }

    // Déconnexion de l'utilisateur
    public function deconnexion()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Déconnexion réussie.',
        ], 200);
    }

    // Détails de l'utilisateur
    public function utilisateur()
    {
        return response([
            'user' => auth()->user(),
        ], 200);
    }

    // Update user
    public function update(Request $request)
    {
        $attrs = $request->validate([
            'nom_utilisateur' => 'required|string',
        ]);

        // Note: Assume you have a 'profiles' directory for storing user images.
        $image = $this->saveImage($request->image, 'profiles');

        auth()->user()->update([
            'nom_utilisateur' => $attrs['nom_utilisateur'],
            'image' => $image,
        ]);

        return response([
            'message' => 'User updated.',
            'user' => auth()->user(),
        ], 200);
    }

    // Custom method to save image (you may need to implement this)
    protected function saveImage($image, $path = 'profiles')
    {
        // Your logic to save the image goes here
        // You might want to use something like Intervention Image for image processing.

        return $image;
    }
}
