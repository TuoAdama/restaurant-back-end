<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_client_id')->unsigned();
            $table->integer('personnel_id')->unsigned();
            $table->dateTime('date_de_commande');
            $table->timestamps();
            
            $table->foreign('table_client_id')
                  ->references('id')
                  ->on('table_clients');
            $table->foreign('personnel_id')
                  ->references('id')
                  ->on('personnels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
