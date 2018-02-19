<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('favoris', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer("money_id")->unsigned();
            $table->foreign('money_id')->references('id')->on('moneys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoris');
    }
}
