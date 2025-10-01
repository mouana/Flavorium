<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{

protected $fillable = ['client','address','phone','user_id','total'];
    // protected $table ="";
    public function user()
{
    return $this->belongsTo(User::class);
}

public function produits()
{
    return $this->belongsToMany(Produit::class, 'commande_produit')
                ->withPivot('quantite','prix','sous_total')
                ->withTimestamps();
}


}