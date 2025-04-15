<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class emp extends Model
{
    protected $fillable = [
        'prenom',
        'ville',
        'services',
        'salaire',
        'Date'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class);
    }
}
