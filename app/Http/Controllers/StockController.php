<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Stock;
use Inertia\Inertia;

class StockController extends Controller
{
    //
    public function index(){
        $stockList = Stock::orderBy("DESIGNATION", "ASC")->paginate(9246);

            // Récupérer les données des autres tables
            // foreach ($stockList as $stock) {
            //     $stock->stock1 = Stock::where('CODE', $stock->CODE)->first();
            //     $stock->stock2 = Stock::where('CODE', $stock->CODE)->first();
            //     $stock->stock3 = Stock::where('CODE', $stock->CODE)->first();
            // }

            return Inertia::render("facturation/stock", [
                "stockLists" => $stockList,
            ]);
    }
}
