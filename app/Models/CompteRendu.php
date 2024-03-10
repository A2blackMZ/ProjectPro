<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteRendu extends Model
{
    use HasFactory;

    protected $fillable = [
        'evenement',
        'difficultes',
        'commentaires',
        'date',
        'approche_solution',
        'action_retenu',
        'projet_id',
    ];

}
