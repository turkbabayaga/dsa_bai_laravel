<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('idea.index'); 
        /**  
        * Passer les instances du model Idea associés à un user à la view idea.index  
        * en utilisant le "eager loading" (with), et trié par ordre chronologique décroissant. 
        **/ 
        
        return view('idea.index', [     
        'idea' => Idea::with('user')->latest()->get(), 
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate : controle du format du message ( obligatoire / chaine de caractère / max 255 caractères )
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'idea_id' => 'required|integred'
        ]);

        // verification : utilisateur max commentaires = 3
        if ($request->user()->comments()
        ->Count()>=3) {
        return redirect()->back()->withErrors(['message_limit_idee' => 'Vous ne pouvez pas poster plus de 3 commentaires']);
        }

        // create : création d'un objet Comments avec le message et l'id de l'utilisateur connecté
        $request->user()->comments()->create($validated);
        // redirect : redirection vers la page d'accueil
        return redirect()->route('idea.index');

        // Test
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        // retourner la view
        $this->authorize('update', $idea); 
        return view('idea.edit', [ 
            'idea' => $idea, 
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        // Contrôler les données 
        $this->authorize('update', $idea); 
        $validated = $request->validate([ 
            'message' => 'required|string|max:255'
        ]); 
        
        // Update 
        
        $idea->update($validated); 
        
        //Rediriger 
        
        return redirect(route('idea.index')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // contrôle autorisation pour delete 
        $this->authorize('delete', $idea); 
        
        // delete 
        $idea->delete(); 
        
        // Rediriger 
        return redirect(route('idea.index')); 
    }
}
