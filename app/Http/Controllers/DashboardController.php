<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre total d'utilisateurs
        $usersCount = User::count();

        // Nombre total d'inscriptions
        $inscriptionsCount = Schema::hasTable('inscriptions')
            ? DB::table('inscriptions')->count()
            : 0;

        // Somme totale des paiements
        $paymentsSum = Schema::hasTable('paiements')
            ? DB::table('paiements')->sum('montant')
            : 0;

        // Retourne la vue avec les données
        return view('dashboard', compact('usersCount', 'inscriptionsCount', 'paymentsSum'));
    }
}
