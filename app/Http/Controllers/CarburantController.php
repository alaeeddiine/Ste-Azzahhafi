<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carburant;
use App\Models\DailyReport;

class CarburantController extends Controller
{
    public function index()
{
    $carburants = Carburant::latest()->get();

    $resume = ['essence' => ['recu' => 0, 'vendu' => 0, 'stock' => 0], 'diesel' => ['recu' => 0, 'vendu' => 0, 'stock' => 0]];

    foreach ($carburants as $c) {
        if ($c->operation == 'reception') {
            $resume[$c->type]['recu'] += $c->quantite;
        } else {
            $resume[$c->type]['vendu'] += $c->quantite;
        }
        $resume[$c->type]['stock'] = $resume[$c->type]['recu'] - $resume[$c->type]['vendu'];
    }

    return view('admin.carburant', compact('carburants', 'resume'));
}

public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:essence,diesel',
        'operation' => 'required|in:reception,vente',
        'quantite' => 'required|numeric|min:0.1',
        'date' => 'required|date',
    ]);

    Carburant::create($request->all());

    return redirect()->route('admin.carburant');
}

}
