<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Proforma;
use App\Models\Stock;
use App\Models\ProformaArticle;

class ProformaController extends Controller
{
    //
    public function index(){

        $proformas = Proforma::all();

        $stockList = Stock::orderBy("DESIGNATION", "ASC")->paginate(20);

        // Récupérer les données des autres tables
        foreach ($stockList as $stock) {
            $stock->stock1 = Stock::where('CODE', $stock->CODE)->first();
            $stock->stock2 = Stock::where('CODE', $stock->CODE)->first();
            $stock->stock3 = Stock::where('CODE', $stock->CODE)->first();
        }

        return inertia("facturation/proforma", [
            'proformas' => $proformas,
            "stockLists" => $stockList,
        ]);
    }

    public function creer(Request $request){
        // Insérer les données dans la table
        foreach ($request->articles as $article) {
            ProformaArticle::create([
                'codeProforma' => $request->codeProforma,
                'designation' => $article['designation'],
                'pu' => $article['pu'],
                'qte' => $article['qte'],
                'remise' => $article['remise'],
                'uv' => $article['uv'],
            ]);
        }

        // Afficher la vue avec un message de succès
        return inertia("facturation/proforma")->with('message', 'Proforma créé avec succès');
    }


    public function enregistrer(Request $request){

           dd($request);
    }
}




