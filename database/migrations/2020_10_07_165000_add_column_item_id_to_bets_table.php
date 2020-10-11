<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnItemIdToBetsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('bets', function (Blueprint $table) {
      $table->foreignId('item_id')
        ->nullable()
        ->references('id')
        ->on('items')
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
    Schema::table('bets', function (Blueprint $table) {
      $table->dropColumn('item_id');
    });
  }
}
