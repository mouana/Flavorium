<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatusEnumInCommandesTable extends Migration
{
    public function up()
    {
        DB::table('commandes')->where('status', 'Noveua')->update(['status' => 'Nouveau']);
    
        DB::statement("ALTER TABLE `commandes` CHANGE `status` `status` ENUM('Livre','Annule','Nouveau','Retour') NOT NULL DEFAULT 'Nouveau'");
    }
    

    public function down()
    {
        DB::statement("ALTER TABLE `commandes` CHANGE `status` `status` ENUM('Livre','Annule','Noveua','Retour') NOT NULL DEFAULT 'Noveua'");
    }
}