<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EtatJournalier;
use App\Models\Carburant;

class EtatJournalierController extends Controller
{
    public function index()
    {
        $etats = EtatJournalier::latest()->get();

        return view('admin.etat', compact('etats'));
    }

    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date|unique:etat_journaliers,date',
        'volume_essence' => 'required|numeric|min:0',
        'volume_diesel' => 'required|numeric|min:0',
        'prix_litre_essence' => 'required|numeric|min:0',
        'prix_litre_diesel' => 'required|numeric|min:0',
        'recette_lavage' => 'nullable|numeric|min:0',
        'recette_urgence' => 'nullable|numeric|min:0',
        'depenses_credits' => 'nullable|numeric|min:0',
        'depenses_autres' => 'nullable|numeric|min:0',
    ]);

    $etat = EtatJournalier::create($request->all());

    // Mettre à jour le stock de carburant
    $stock = \App\Models\Stock::first(); // ou selon votre logique de sélection du stock
    if ($stock) {
        $stock->essence = max(0, $stock->essence - $request->input('volume_essence'));
        $stock->diesel = max(0, $stock->diesel - $request->input('volume_diesel'));
        $stock->save();
    }

    return redirect()->route('admin.etat')->with('success', 'État journalier ajouté et stock mis à jour');
}
}
