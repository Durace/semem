<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Proforma;
use App\Models\Stock;
use App\Models\ProformaArticle;


class ProformaController extends Controller
{
    //
    public function index(){
        // dd(Session::all());
        // dd(Auth::user());
        $proformas = Proforma::all();

        $stockList = Stock::orderBy("DESIGNATION", "ASC")->paginate(9246);


        // Récupérer la dernière valeur de numProforma dans la table Proforma
        $dernierProforma = Proforma::orderBy('created_at', 'desc')->first();
        $articlesProforma = [];
        if ($dernierProforma) {
            $articlesProforma = ProformaArticle::where('codeProforma', $dernierProforma->numProforma)->get();
        }

        return inertia("facturation/proforma", [
            'proformas' => $proformas,
            "stockLists" => $stockList,
            "articlesProforma" => $articlesProforma,
            'sessionData' => Session::all(), // Passe toutes les données de la session
            'user' => Auth::user() // passe les données de l'utilisateur
        ]);
    }

    public function creer(Request $request){

        // Créer ou mettre à jour le proforma si le même existe déjà
        Proforma::updateOrCreate(
            ['numProforma' => $request->numProforma],
            [
                'date' => $request->date,
                'heure' => $request->heure,
                'typeProforma' => $request->typeProforma,
                'client' => $request->client,
                'acheteur' => $request->acheteur,
                'commercial' => $request->commercial,
                'vendeur' => $request->vendeur,
                'da' => $request->da
            ]
        );

        // Afficher la vue avec un message de succès
        return inertia("facturation/proforma")->with('message', 'Proforma créé avec succès');

    }

    public function enregistrer(Request $request){

        Log::info('Début de la méthode enregistrer');

        // Récupérer les données envoyées par axios
        $articles = $request->input('articles');
        $codeProforma = $request->input('codeProforma');


        Proforma::where('numProforma', $request->codeProforma)->update([
            'precompte' => $request->precompte,
        ]);

        Log::info('Données reçues:', ['codeProforma' => $codeProforma, 'articles' => $articles]);

        echo $codeProforma;

        // Supprimer les anciennes entrées avant d'enregistrer les nouvelles
        ProformaArticle::where('codeProforma', $codeProforma)->delete();

        // Enregistrer les nouvelles données dans la table ProformaArticle
        try {
            foreach ($articles as $article) {
                Log::info('Traitement de l\'article:', $article);

                ProformaArticle::create([
                    'codeProforma' => $codeProforma,
                    'designation' => $article['designation'],
                    'pu' => $article['pu'],
                    'qte' => $article['qte'],
                    'remise' => $article['remise'],
                    'uv' => $article['uv']
                ]);

                Log::info('Article traité avec succès');
            }

            Log::info('Tous les articles ont été traités avec succès');
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement des articles:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Une erreur est survenue lors du traitement des données'], 500);
        }

        Log::info('Fin de la méthode enregistrer');
        return response()->json(['message' => 'Données enregistrées avec succès'], 200);
    }

    public function rechercheProforma(Request $request)
{
    // Exemple de traitement pour récupérer les données de la proforma

    // $stockList = Stock::orderBy("DESIGNATION", "ASC")->paginate(9246);

    Log::info('Début de la méthode rechercheProforma');

    $numProforma = $request->numProforma;

    $articlesProforma = ProformaArticle::where('codeProforma', $numProforma)->get();

    $proformas = Proforma::all();

    // Retourner les données en JSON pour la mise à jour dynamique
    return response()->json([
        // "stockLists" => $stockList,
        "articlesProforma" => $articlesProforma,
        "numProforma" => $numProforma,
        'proformas' => $proformas,
    ]);
}



    public function destroy($numProforma)
    {
        // Trouver la proforma par son numéro
        $proforma = Proforma::where('numProforma', $numProforma)->first();

        if ($proforma) {
            // Supprimer la proforma
            $proforma->delete();
            return response()->json(['message' => 'Proforma supprimée avec succès.'], 200);
        }

        return response()->json(['message' => 'Proforma non trouvée.'], 404);
    }



}




