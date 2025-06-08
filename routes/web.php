<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\MouvementStockController;

// Public routes (no auth required)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/acceuil', function () {
    return view('front.acceuil');
})->name('Front.Acceuil');
Route::get('/about', function () {
    return view('Front.about');
})->name('Front.about');
Route::get('/contact', function () {
    return view('Front.contact');
})->name('Front.contact');
Route::get('acceuil',[HomeController::class,'index'])->name('Front.Acceuil');
Route::get('/nos-produits', [ProduitController::class, 'front'])->name('produits.front');
Route::get('/noproduit', [ProduitController::class, 'catalogue'])->name('commands.cataloge');

// Authenticated routes group
Route::middleware(['auth'])->group(function () {
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Produits
    Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
    Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');
    Route::get('/cataloges', [ProduitController::class, 'front'])->name('produits.front');
    Route::get('/cart', [CommandeController::class, 'showCart'])->name('cart.show');
    // Route::get('/cart/add/{id}', [CommandeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart', [CartController::class, 'view'])->name('cart.view');

    Route::resource('users', UserController::class);
    
    Route::resource('categories', CategorieController::class);
    
    Route::get('/statistiques/globales', [StatistiqueController::class, 'globales'])->name('statistiques.globales');
    Route::get('/statistiques/utilisateur/{id}', [StatistiqueController::class, 'parUtilisateur'])->name('statistiques.utilisateur');
    
    Route::get('/mouvements', [MouvementStockController::class, 'index'])->name('mouvements.index');
    Route::get('/mouvements/create', [MouvementStockController::class, 'create'])->name('mouvements.create');
    Route::post('/mouvements', [MouvementStockController::class, 'store'])->name('mouvements.store');
    Route::get('/mouvements/{id}', [MouvementStockController::class, 'show'])->name('mouvements.show');
    Route::get('/mouvements/{id}/edit', [MouvementStockController::class, 'edit'])->name('mouvements.edit');
    Route::put('/mouvements/{id}', [MouvementStockController::class, 'update'])->name('mouvements.update');
    Route::delete('/mouvements/{id}', [MouvementStockController::class, 'destroy'])->name('mouvements.destroy');
    
    Route::get('/produits/{produit}/mouvements', [MouvementStockController::class, 'productMovements'])
        ->name('produits.mouvements');

        Route::post('/produits/{produit}/mouvements', [MouvementStockController::class, 'adjustStock'])
        ->name('produits.mouvements.store');
    Route::get('/mouvements/{mouvement}', [MouvementStockController::class, 'show'])
        ->name('mouvements.show');

        Route::get('/mon-compte', [UserController::class, 'showAccount'])->name('mon-compte');
        Route::post('/compte', [ProfileController::class, 'monCompte'])->name('mon-compte');
       Route::put('/mon-compte/update', [ProfileController::class, 'update'])->name('mon-compte.update');
    Route::put('/mon-compte/password', [ProfileController::class, 'updatePassword'])->name('mon-compte.password');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/commandes', [CommandeController::class, 'index'])->name('commands.index');
        Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commands.create');
        Route::post('/commandes', [CommandeController::class, 'store'])->name('commands.store');
        Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commands.show');
        Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commands.destroy');
        Route::get('/commands/{commande}/edit', [CommandeController::class, 'edit'])->name('commands.edit');
Route::put('/commands/{commande}', [CommandeController::class, 'update'])->name('commands.update');
Route::get('/commands/{command}/print', [CommandeController::class, 'print'])->name('commands.print');
Route::patch('/commands/{commande}/status', [CommandeController::class, 'updateStatus'])->name('commands.updateStatus');
Route::put('/commands/{id}/archive', [CommandeController::class, 'updateArchive'])->name('commands.updateArchive');

Route::get('/products', [CartController::class, 'products'])->name('products.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
 Route::post('/empty', [CartController::class, 'empty'])->name('cart.empty');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

});