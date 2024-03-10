<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


// Routes admins
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes utilisateurs
Route::post('/enregistrer', [UtilisateurController::class, 'enregistrer']);
Route::post('/connexion', [UtilisateurController::class, 'connexion']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User (Admin)
    Route::post('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Administrateur
    Route::get('/utilisateurs', [UtilisateurController::class, 'index']); // all users
    Route::post('/utilisateurs', [UtilisateurController::class, 'store']); // create user
    Route::get('/utilisateur/{id}', [UtilisateurController::class, 'show']); // get single user
    Route::put('/utilisateur/{id}', [UtilisateurController::class, 'update']); // update user
    Route::delete('/utilisateur/{id}', [UtilisateurController::class, 'destroy']); // delete user
    //Route::delete('/utilisateur/{id}', [TaskController::class, 'destroy']); // block user

    Route::get('/roles', [RoleController::class, 'index']); // all roles
    Route::post('/roles', [RoleController::class, 'store']); // create role
    Route::get('/role/{id}', [RoleController::class, 'show']); // get single role
    Route::put('/role/{id}', [RoleController::class, 'update']); // update role
    Route::delete('/role/{id}', [RoleController::class, 'destroy']); // delete role

    //Route pour la gestion des statuts
    Route::put('/tasks/{id}/change-status', [TaskController::class, 'changeStatus']);

});


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // Utilisateur
    Route::post('/utilisateur', [UtilisateurController::class, 'utilisateur']); //détails du user
    Route::put('/modifier', [AuthController::class, 'modifier']);
    Route::post('/deconnexion', [AuthController::class, 'deconnexion']);

    // Projets de l'utilisateur
    Route::get('/projets', [ProjetController::class, 'index']); // all projects
    Route::post('/projets', [ProjetController::class, 'store']); // create project
    Route::get('/projet/{id}', [ProjetController::class, 'show']); // get single project
    Route::put('/projet/{id}', [ProjetController::class, 'update']); // update project
    Route::delete('/projet/{id}', [ProjetController::class, 'destroy']); // delete project

    // Route pour la gestion des statuts
    Route::put('/tasks/{id}/change-status', [TaskController::class, 'changeStatus']);

});
