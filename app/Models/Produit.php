<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\MouvementStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'description',
        'prix',
        'prix_vente',
        'stock',
        'seuil_critique',
        'categorie_id',
        'photo',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class);
    }

    // Accessor pour chiffre d'affaires
    public function getChiffreAffairesAttribute()
    {
        return $this->mouvements()
            ->where('type', 'sortie')
            ->sum(DB::raw('quantite * prix'));
    }

    // Accessor pour revenus
    public function getRevenusAttribute()
    {
        $ca = $this->chiffre_affaires;
        $cout = $this->mouvements()
            ->where('type', 'entree')
            ->sum(DB::raw('quantite * prix'));
        return $ca - $cout;
    }
}