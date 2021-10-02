<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plat_commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commande_id')->unsigned();
            $table->integer('plat_id')->unsigned();
            $table->integer('quantite')->unsigned();
            $table->timestamps();
            
            $table->foreign('commande_id')
                  ->references('id')
                  ->on('commandes')
                  ->onDelete('cascade');
            
          $table->foreign('plat_id')
                ->references('id')
                ->on('plats')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plat_commandes');
    }
}
