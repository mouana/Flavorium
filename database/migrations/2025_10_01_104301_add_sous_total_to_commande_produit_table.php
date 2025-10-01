<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('commande_produit', function (Blueprint $table) {
        $table->decimal('sous_total', 10, 2)->default(0);
    });
}

public function down()
{
    Schema::table('commande_produit', function (Blueprint $table) {
        $table->dropColumn('sous_total');
    });
}

};