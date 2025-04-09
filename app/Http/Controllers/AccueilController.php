<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Inertia\Inertia;

class AccueilController extends Controller
{
    //
    public function index(){

        // dd(Session::all());
        // dd(Auth::user());

        // if(Auth::user() == NULL){
        //     return Inertia::render('auth/connexion');

        // } else {
        //     return Inertia::render('Accueil');
        // }


        return Inertia::render('Accueil', [
            'sessionData' => Session::all(), // Passe toutes les données de la session
            'user' => Auth::user()
        ]);
    }
}
