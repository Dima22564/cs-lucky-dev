<?php

use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \Illuminate\Support\Facades\DB::table('colors')
      ->insert([
        ['from' => 1.00, 'to' => 1.58, 'color' => '#5d2de1'],
        ['from' => 1.58, 'to' => 2.14, 'color' => '#c32de1'],
        ['from' => 2.14, 'to' => 4.47, 'color' => '#00ffaa'],
        ['from' => 4.47, 'to' => 14.85, 'color' => '#eeff00'],
        ['from' => 14.85, 'to' => 43.74, 'color' => '#00bbff'],
        ['from' => 43.74, 'to' => 100.00, 'color' => '#00bbff']
      ]);
  }
}
