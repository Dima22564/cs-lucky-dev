<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('games_users', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreignId('game_id')->references('id')->on('games')->onDelete('cascade');
      $table->float('bet');
      $table->string('status');
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
    Schema::dropIfExists('games_users');
  }
}
