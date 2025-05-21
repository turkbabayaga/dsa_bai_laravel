<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Logs;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credential = $request->only('email', 'password');
        $userExiste = User::where('email', $credential['email'])->first();

        if(!$userExiste){
            Logs::create([
                'user_id' => NULL,
                'action' => 'Connexion ratée - Email incorrect',
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'created_at' => now(),
            ]);
    
            return back()->withErrors(['email' => 'Problème lors de la connexion']);
        } elseif(!Hash::check($credential['password'], $userExiste->password)) {
            Logs::create([
                'user_id' => NULL,
                'action' => 'Connexion ratée - Mot de passe incorrect',
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'created_at' => now(),
            ]);
    
            return back()->withErrors(['email' => 'Problème lors de la connexion']);
        } 

        $request->authenticate();
        $request->session()->regenerate();

        Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Connexion réussie',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);
        
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
