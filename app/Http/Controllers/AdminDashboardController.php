<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\EtatJournalier;
use App\Models\Carburant;
use App\Models\Employe;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dates = collect();
        $ventes = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $etat = EtatJournalier::whereDate('date', $date)->first();

            $dates->push(Carbon::parse($date)->format('d M'));
            $ventes->push($etat ? $etat->recette_totale : 0);
        }

        
        $totalEmployees = Employe::count();
        $totalEssence = Carburant::where('type', 'essence')->sum('quantite');
        $totalDiesel = Carburant::where('type', 'diesel')->sum('quantite');

        $totalCarburant = $totalEssence + $totalDiesel;
        $stockTotal = Stock::sum('quantite'); // adjust if you have types/categories
        // Ventes, Recettes, Bénéfices aujourd’hui (depuis les états journaliers)
        $etatToday = EtatJournalier::whereDate('created_at', Carbon::today())->first();
        $etatYesterday = EtatJournalier::whereDate('created_at', Carbon::yesterday())->first();

        $ventesToday = $etatToday?->ventes_totales ?? 0;
        $recettesToday = $etatToday?->recette_totale ?? 0;
        $beneficesToday = $etatToday?->benefice_net ?? 0;
        
        // Comparaison avec hier
        $evolutionVente = $etatYesterday && $etatYesterday->ventes_totales > 0
            ? round((($ventesToday - $etatYesterday->ventes_totales) / $etatYesterday->ventes_totales) * 100, 2)
            : 0;

        $evolutionRecette = $etatYesterday && $etatYesterday->recette_totale > 0
            ? round((($recettesToday - $etatYesterday->recette_totale) / $etatYesterday->recette_totale) * 100, 2)
            : 0;

        $evolutionBenefice = $etatYesterday && $etatYesterday->benefice_net > 0
            ? round((($beneficesToday - $etatYesterday->benefice_net) / $etatYesterday->benefice_net) * 100, 2)
            : 0;

        return view('admin.dashboard', compact(
            'totalEmployees',
            'totalCarburant',
            'totalEssence',
            'totalDiesel',
            'stockTotal',
            'ventesToday',
            'recettesToday',
            'beneficesToday',
            'evolutionVente',
            'evolutionRecette',
            'evolutionBenefice',
            'dates',
            'ventes'
        ));
    }


    /**
     * Handle other admin-specific actions.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageUsers()
    {
        // Example: Logic to manage users
        return response()->json(['message' => 'Manage users functionality']);
    }
}