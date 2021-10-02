<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poste_id')->unsigned();
            $table->string('nom');
            $table->string('prenom');
            $table->char('sexe');
            $table->date('date_de_naissance');
            $table->timestamps();
            
            $table->foreign('poste_id')
                  ->references('id')
                  ->on('postes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
}
