<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proforma;
use App\Models\ProformaArticle;
use Barryvdh\DomPDF\Facade\Pdf;

class ImpressionProformaController extends Controller
{
    public function index(Request $request){

        $proforma = Proforma::where('numProforma', $request->numProforma)->first();

        $proformaArticles = ProformaArticle::where('codeProforma', $request->numProforma)->get();

        if($proforma && $proformaArticles) {
            // return view("impression.facturation.proforma", [
            //     'proforma' => $proforma,
            //     'proformaArticles' => $proformaArticles]);

                $data = ['proforma'=> $proforma,
                     'proformaArticles'=> $proformaArticles];

            $pdf = Pdf::loadView('impression.facturation.proforma', $data);

            return $pdf->download( $proforma->numProforma . '.pdf');
        } else {
            abort(404);
        }
    }
}
