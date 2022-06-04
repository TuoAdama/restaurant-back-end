<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categorie_id')->unsigned();
            $table->string('libelle');
            $table->timestamps();
            
            $table->foreign('categorie_id')
                  ->references('id')
                  ->on('categories')
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
        Schema::table('plats', function (Blueprint $table) {
            $table->dropForeign('id_categorie');
            $table->dropIndex('id_categorie');
            $table->dropColumn('id_categorie');
        });
        Schema::dropIfExists('plats');
    }
}
