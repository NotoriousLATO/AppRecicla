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
            $table->string('image')->nullable(); // Para almacenar la ruta de la imagen
            $table->string('material')->nullable(); // Material reciclable seleccionado
        });
    }
    
    public function down()
    {
        Schema::table('ofertas', function (Blueprint $table) {
            $table->dropColumn(['image', 'material']);
        });
    }
    
};
