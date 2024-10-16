<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StockController;
use App\Http\Controllers\ProformaController;

Route::get('/', function () {
    return inertia('Accueil');
});



Route::get('/facturation-proformat', [ProformaController::class,'index'])->name('');
Route::post('/facturation-proformat', [ProformaController::class, 'creer'])->name('facturation.proforma.creer');
Route::post('/enregistrer', [ProformaController::class, 'enregistrer'])->name('enregistrer');



Route::get('/facturation-stock', [StockController::class,'index'])->name('facturation.stock');



