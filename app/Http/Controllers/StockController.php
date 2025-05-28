<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::latest()->get();

        $resume = [
            'huile' => ['recu' => 0, 'vendu' => 0, 'stock' => 0],
            'essence' => ['recu' => 0, 'vendu' => 0, 'stock' => 0],
            'accessoires' => ['recu' => 0, 'vendu' => 0, 'stock' => 0],
        ];

        foreach ($stocks as $s) {
            $produit = strtolower(trim($s->produit));

            if (!isset($resume[$produit])) {
                continue; // ignorer produits inconnus
            }

            if ($s->operation === 'reception') {
                $resume[$produit]['recu'] += $s->quantite;
            } else {
                $resume[$produit]['vendu'] += $s->quantite;
            }

            $resume[$produit]['stock'] = $resume[$produit]['recu'] - $resume[$produit]['vendu'];
        }

        return view('admin.stock', compact('stocks', 'resume'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit' => 'required|in:huile,Addictif essence/diesel,accessoires',
            'operation' => 'required|in:reception,vente',
            'quantite' => 'required|numeric|min:0.1',
            'date' => 'required|date',
        ]);

        Stock::create($request->only('produit', 'operation', 'quantite', 'date'));

        return redirect()->route('admin.stock')->with('success', 'Stock mis à jour avec succès.');
    }
}
