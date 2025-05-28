<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::all();
        return view('admin.employes', compact('employes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'salaire' => 'required|numeric|min:0',
            'poste' => 'required|string|max:100',
            'date_embauche' => 'required|date',
            'horaire_debut' => 'required|date_format:H:i',
            'horaire_fin' => 'required|date_format:H:i',
        ]);

        Employe::create([
            'nom' => $request->nom,
            'age' => $request->age,
            'salaire' => $request->salaire,
            'poste' => $request->poste,
            'date_embauche' => $request->date_embauche,
            'horaire_debut' => $request->horaire_debut,
            'horaire_fin' => $request->horaire_fin,
        ]);

        return redirect()->back()->with('success', 'Employé ajouté avec succès.');
}

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('admin.employes');
    }
}
