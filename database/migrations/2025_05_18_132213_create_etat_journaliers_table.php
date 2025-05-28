<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etat_journaliers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            
            // Volume vendu
            $table->decimal('volume_essence', 8, 2);
            $table->decimal('volume_diesel', 8, 2);
            
            // Prix au litre
            $table->decimal('prix_litre_essence', 6, 2);
            $table->decimal('prix_litre_diesel', 6, 2);
            
            // Recettes autres services
            $table->decimal('recette_lavage', 8, 2)->default(0);
            $table->decimal('recette_urgence', 8, 2)->default(0);
            
            // Dépenses
            $table->decimal('depenses_credits', 8, 2)->default(0);
            $table->decimal('depenses_autres', 8, 2)->default(0);
            
            $table->timestamps();
        });
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etat_journaliers');
    }
};
