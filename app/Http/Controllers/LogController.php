<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des logs avec filtre par date
        $query = Logs::query();

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('index', compact('logs'));
    }
}
