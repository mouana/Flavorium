<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{

    protected $fillable =['user_id','phone','address','client'];
    // protected $table ="";
    public function user()
{
    return $this->belongsTo(User::class);
}

public function produits()
{
    return $this->belongsToMany(Produit::class, 'commande_produit')
                ->withPivot('quantite')
                ->withTimestamps();
}


}