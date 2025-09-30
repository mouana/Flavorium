<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commande_produit', function (Blueprint $table) {
            // Ajoute une colonne 'prix' après 'quantite'
            $table->decimal('prix', 8, 2)->nullable()->after('quantite');
        });
    }

    public function down(): void
    {
        Schema::table('commande_produit', function (Blueprint $table) {
            $table->dropColumn('prix');
        });
    }
};