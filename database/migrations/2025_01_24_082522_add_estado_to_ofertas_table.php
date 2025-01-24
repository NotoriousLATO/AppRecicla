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
    Schema::table('ofertas', function (Blueprint $table) {
        $table->string('estado')->default('disponible'); // Cambia el tipo y valor por lo que necesites
    });
}


    /**
     * Reverse the migrations.
     */
   
     public function down()
     {
         Schema::table('ofertas', function (Blueprint $table) {
             $table->dropColumn('estado');
         });
     }
     
};