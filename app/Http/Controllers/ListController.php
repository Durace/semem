<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


use App\Models\Proforma;


class ListController extends Controller
{
    //
    public function indexGeneral (){
        $proformas = Proforma::orderBy('id', 'desc')->get();

        return inertia ("list/liste-generale",[
            'proformas' => $proformas,
            'sessionData' => Session::all(), // Passe toutes les données de la session
            'user' => Auth::user() // passe les données de l'utilisateur
        ]);

    }

    public function indexPersonnel(){

        $proformas = Proforma::where('commercial', auth()->user()->name)
            ->orderBy('id', 'desc')
            ->get();


        return inertia ("list/liste-generale",[
            'proformas' => $proformas,
            'sessionData' => Session::all(), // Passe toutes les données de la session
            'user' => Auth::user() // passe les données de l'utilisateur
        ]);
    }
}
