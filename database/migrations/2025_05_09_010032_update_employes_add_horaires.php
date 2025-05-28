<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->time('horaire_debut')->nullable();
            $table->time('horaire_fin')->nullable();
            $table->dropColumn('horaire_travail');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
