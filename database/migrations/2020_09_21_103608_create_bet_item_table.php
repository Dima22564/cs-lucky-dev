<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetItemTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bet_item', function (Blueprint $table) {
      $table->id();
      $table->foreignId('bet_id')
        ->references('id')
        ->on('bets')
        ->onDelete('cascade');
      $table->foreignId('item_id')
        ->references('id')
        ->on('items')
        ->onDelete('cascade');
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
    Schema::dropIfExists('bet_item');
  }
}
