<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Stock;
use App\Models\Bafoussam;
use App\Models\Camair;
use App\Models\Mokolo;
use App\Models\Olezoa;
use App\Models\Junior;
use Inertia\Inertia;

class StockController extends Controller
{
    //
    public function index(){

        // Récupérer les données de lutilisateur connecté
        $user = auth()->user();
        $userId = $user->id;
        $userName = $user->name;
        $userAgence = $user->agence;
        $userEmail = $user->email;
        $userCode = $user->code;

        // Afficher les données d'une table selon que le nom de lagence correspond à la table
        // Pour éviter les problèmes de casse mettre le tout en majuscule 
        if (strtoupper($userAgence) == strtoupper("AkwA")) {
            $stockList = Stock::orderBy("DESIGNATION", "ASC")->paginate(9246);
        } elseif (strtoupper ($userAgence) == strtoupper ("Bafoussams")) {
            $stockList = Bafoussam::orderBy("DESIGNATION", "ASC")->paginate(9246);
        } elseif (strtoupper ($userAgence) == strtoupper ("Camairs")) {
            $stockstrtoupperList = Camair::orderBy("DESIGNATION", "ASC")->paginate(9246);
        } elseif (strtoupper ($userAgence) == strtoupper ("Mokolos")) {
            $stockList = Mokolo::orderBy("DESIGNATION", "ASC")->paginate(9246);
        } elseif (strtoupper ($userAgence) == strtoupper ("Olezoas")) {
            $stockList = Olezoa::orderBy("DstrtoupperESIGNATION", "ASC")->paginate(9246);
        } elseif (strtoupper ($userAgence) == strtoupper ("Juniors")) {
            $stockList = Junior::orderBy("DESIGNATION", "ASC")->paginate(9246);
        } else {
            // Si l'agence ne correspond à aucune table, vous pouvez gérer cela comme vous le souhaitez
            // Par exemple, vous pouvez rediriger vers une page d'erreur ou afficher un message
            dd("error Agence non reconnue.");
        }

        return Inertia::render("facturation/stock", [
            "stockLists" => $stockList,
        ]);
    }

    public function stock_global(){

        $stockList = Stock::select('DESIGNATION', 'QTE_STOCK', 'CODE')
                      ->orderBy('DESIGNATION', 'ASC')
                      ->paginate(9246);
                    //   ->paginate(9246);
        // $bafoussam = Bafoussam::select('DESIGNATION', 'QTE_STOCK')
        //               ->orderBy('DESIGNATION', 'ASC')
        //               ->paginate(8750);
        // $camair = Camair::select('DESIGNATION', 'QTE_STOCK')
        //               ->orderBy('DESIGNATION', 'ASC')
        //               ->paginate(8919);
        // $mokolo = Mokolo::select('DESIGNATION', 'QTE_STOCK')
        //               ->orderBy('DESIGNATION', 'ASC')
        //               ->paginate(8784);
        // $olezoa = olezoa::select('DESIGNATION', 'QTE_STOCK')
        //               ->orderBy('DESIGNATION', 'ASC')
        //               ->paginate(9224);
        // $junior = Junior::select('DESIGNATION', 'QTE_STOCK')
        //               ->orderBy('DESIGNATION', 'ASC')
        //               ->paginate(7690);

    return Inertia::render('facturation/stockGlobal', [
        'stockLists' => $stockList,
        // 'bafoussams' => $bafoussam,
        // 'camairs' => $camair,
        // 'mokolos' => $mokolo,
        // 'olezoas' => $olezoa,
        // 'juniors' => $junior,
    ]);
    }

    public function getQuantites($code){

        // Récupérer les quantités dans les différents modèles (exemple fictif)
        $quantites = [
            'stock_akwa' => Stock::where('CODE', $code)->sum('QTE_STOCK'),
            'stock_bafoussam' => Bafoussam::where('CODE', $code)->sum('QTE_STOCK'),
            'stock_camair' => Camair::where('CODE', $code)->sum('QTE_STOCK'),
            'stock_mokolo' => Mokolo::where('CODE', $code)->sum('QTE_STOCK'),
            'stock_olezoa' => Olezoa::where('CODE', $code)->sum('QTE_STOCK'),
            'stock_junior' => Junior::where('CODE', $code)->sum('QTE_STOCK'),
        ];

        return response()->json($quantites);
    }


}
