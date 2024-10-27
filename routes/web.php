<?php

use App\Http\Controllers\ImpressionProformaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StockController;
use App\Http\Controllers\ProformaController;

Route::get('/', function () {
    return inertia('Accueil');
});



Route::get('/facturation-proformat', [ProformaController::class,'index'])->name('');
Route::post('/facturation-proformat', [ProformaController::class, 'creer'])->name('facturation.proforma.creer');
Route::post('/enregistrer', [ProformaController::class, 'enregistrer'])->name('enregistrer');
Route::get('/{numProforma}', [ProformaController::class, 'rechercheProforma'])->name('rechercheProforma');


// routes/web.php

Route::delete('/supprimer/{numProforma}', [ProformaController::class, 'destroy']);






Route::get('/facturation-stock', [StockController::class,'index'])->name('facturation.stock');


Route::get('/impression-facturation-proformas/{numProforma}', [ImpressionProformaController::class, 'index'])->name('impression.facturation.proformas.index');





