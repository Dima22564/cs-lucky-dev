<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('games', function (Blueprint $table) {
      $table->id();
      $table->string('hash')->nullable();
      $table->float('multiplier')->nullable();
      $table->integer('skins')->default(0);
      $table->integer('status')->nullable();
      $table->float('profit')->default(0.00);
      $table->integer('players')->default(0)->unsigned();
      $table->float('bank')->default(0.00);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('games');
  }
}
