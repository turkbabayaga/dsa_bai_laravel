<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showUserName()
    {
        // Récupère l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Exécute une requête SQL brute pour récupérer le nom de l'utilisateur
        $user = DB::select('SELECT name FROM users WHERE id = :id LIMIT 1', ['id' => $userId]);

        // Vérifie si un utilisateur a été trouvé et affiche son nom
        if ($user) {
            return view('dashboard')->with('userName', $user[0]->name);
        } else {
            return "Aucun utilisateur trouvé.";
        }
    }
}
