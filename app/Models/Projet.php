<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_projet',
        'budget_alloue',
        'budget_depense',
        'objectif',
        'risques',
        'date_debut',
        'date_fin_prevue',
        'jour_compte_rendu',
        //'user_id',
    ];

    public function membres()
    {
        return $this->hasMany(MembreProjet::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
