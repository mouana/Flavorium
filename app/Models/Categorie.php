<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{

    use HasFactory;

    protected $fillable=[
        'nom',
        'description'
    ];
    public function produits()
{
    return $this->hasMany(Produit::class);
}
}