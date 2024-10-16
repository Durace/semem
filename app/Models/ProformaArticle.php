<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'codeProforma',
        'designation',
        'pu',
        'qte',
        'remise',
        'uv',
    ];
}
