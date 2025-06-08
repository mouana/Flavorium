<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $produits = Produit::latest()->take(6)->get();
        return view('Front.Acceuil',compact('produits'));
    }
}