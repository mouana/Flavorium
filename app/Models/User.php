<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Commande;
use App\Models\Notification;
use App\Models\MouvementStock;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'role'
    ];

    protected $table = 'utilisateurs';

   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mot_de_passe' => 'hashed',
        ];
    }

//     public function mouvements($id)
// {
//     $produit = Produit::with('mouvements.user')->findOrFail($id);
//     return view('produits.mouvements', compact('produit'));
// }

public function mouvements()
{
    return $this->hasMany(MouvementStock::class, 'produit_id');
}


public function notifications()
{
    return $this->hasMany(Notification::class);
}

public function commandes()
{
    return $this->hasMany(Commande::class);
}
}