<?php

use App\Http\Controllers\ImpressionProformaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StockController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccueilController;


Route::middleware('auth')->group(function (){
    Route::get('/', [AccueilController::class, 'index'])->name('accueil')->middleware('auth');
    Route::get('/facturation-proformat', [ProformaController::class, 'index'])->name('');
    Route::post('/facturation-proformat', [ProformaController::class, 'creer'])->name('facturation.proforma.creer');
    Route::post('/enregistrer', [ProformaController::class, 'enregistrer'])->name('enregistrer');
    Route::get('/proforma/{numProforma}', [ProformaController::class, 'rechercheProforma'])->name('rechercheProforma');
    Route::delete('/supprimer/{numProforma}', [ProformaController::class, 'destroy']);

    Route::get('/facturation-stock', [StockController::class, 'index'])->name('facturation.stock');
    Route::get('/stock-global', [StockController::class, 'stock_global'])->name('facturation.stock');
    Route::get('/get-stock/{codeArticle}', [StockController::class, 'getQuantites'])->name('facturation.stock');

    Route::get('/impression-facturation-proformas/{numProforma}', [ImpressionProformaController::class, 'index'])->name('impression.facturation.proformas.index');
});


// Auth
Route::get('create', [AuthController::class, 'index'])->name('auth.create');
Route::post('create', [AuthController::class, 'create'])->name('auth.create');

Route::get('connexion', [AuthController::class, 'connexion'])->name('auth.connexion');
Route::post('connexion', [AuthController::class, 'Goconnexion'])->name('auth.connexion');

Route::post('deconnexion', [AuthController::class, 'deconnexion'])->name('auth.deconnexion');






