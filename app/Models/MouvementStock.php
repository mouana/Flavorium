<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produit;
use App\Enums\TypeMouvement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MouvementStock extends Model
{
    use HasFactory;

    protected $table ='mouvement_stock';
    protected $casts = [
        'type' => TypeMouvement::class,
        'date' => 'datetime',
    ];

    protected $fillable = [
        'type',
        'quantite',
        'produit_id',
        'date',
        'prix',
        'utilisateur_id',
    ];

    // Inverse relationship with Produit
    public function produit()
{
    return $this->belongsTo(Produit::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}