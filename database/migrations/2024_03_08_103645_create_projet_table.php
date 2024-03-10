<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Projet;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('nom_projet');
            $table->string('budget_alloue');
            $table->string('budget_depense');
            $table->string('objectif');
            $table->string('risques');
            $table->date('date_debut')->nullable();
            $table->date('date_fin_prevue')->nullable();
            $table->date('jour_compte_rendu');
            //$table->unsignedBigInteger('user_id'); Disable for the moment : Colonne pour la clé étrangère vers la table "Utilisateurs"
            //$table->foreign('user_id')->references('id')->on('users'); Disable for the moment : Clé étrangère vers la table "Utilisateurs"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
