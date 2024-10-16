<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'numProforma',
        'date',
        'heure',
        'typeProforma',
        'typeFiscal',
        'client',
        'acheteur',
        'commercial',
        'vendeur',
        'da',
    ];
}
