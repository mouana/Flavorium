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
use App\Http\Controllers\CommandeProduitController;

// Public routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/acceuil', [HomeController::class, 'index'])->name('Front.Acceuil');
Route::get('/about', function () { return view('Front.about'); })->name('Front.about');
Route::get('/contact', function () { return view('Front.contact'); })->name('Front.contact');
Route::get('/nos-produits', [ProduitController::class, 'front'])->name('produits.front');
Route::get('/cataloges', [ProduitController::class, 'front'])->name('produits.front');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produits CRUD
    Route::resource('produits', ProduitController::class);

    // Users CRUD
    Route::resource('users', UserController::class);

    // Categories CRUD
    Route::resource('categories', CategorieController::class);

    // Stock movements
    Route::resource('mouvements', MouvementStockController::class);
    Route::post('/produits/{produit}/mouvements', [MouvementStockController::class, 'adjustStock'])->name('produits.mouvements.store');
    Route::get('/produits/{produit}/mouvements', [MouvementStockController::class, 'productMovements'])->name('produits.mouvements');

    // Statistiques
    Route::get('/statistiques/globales', [StatistiqueController::class, 'globales'])->name('statistiques.globales');
    Route::get('/statistiques/utilisateur/{id}', [StatistiqueController::class, 'parUtilisateur'])->name('statistiques.utilisateur');

    // Mon compte
    Route::get('/mon-compte', [UserController::class, 'showAccount'])->name('mon-compte');
    Route::put('/mon-compte/update', [ProfileController::class, 'update'])->name('mon-compte.update');
    Route::put('/mon-compte/password', [ProfileController::class, 'updatePassword'])->name('mon-compte.password');

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commands.index');
    Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commands.create');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commands.show');
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commands.destroy');
    Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->name('commands.edit');
    Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commands.update');
    Route::get('/commandes/{commande}/print', [CommandeController::class, 'print'])->name('commands.print');
    Route::patch('/commandes/{commande}/status', [CommandeController::class, 'updateStatus'])->name('commands.updateStatus');
    Route::put('/commandes/{commande}/archive', [CommandeController::class, 'updateArchive'])->name('commands.updateArchive');

    // Ajouter produits à une commande existante
    Route::post('/commandes/{commande}/produits', [CommandeProduitController::class, 'store'])->name('commands.produits.store');

    // Cart routes
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Produits (liste frontend)
    Route::get('/products', [CartController::class, 'products'])->name('products.index');
    Route::get('/dashboard/statistiques', [DashboardController::class, 'statistiquesAchats'])
    ->name('dashboard.statistiques');

});