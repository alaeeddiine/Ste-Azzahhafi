<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carburants', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['essence', 'diesel']);
            $table->enum('operation', ['reception', 'vente']);
            $table->decimal('quantite', 8, 2);
            $table->string('fournisseur')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carburants');
    }
};

