<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(\App\User::class, 20)->create();
    \App\User::all()->each(function ($user) {
      $items = rand(0, 20);
      for ($i = 0; $i < $items; $i++) {
        \Illuminate\Support\Facades\DB::table('inventories')
          ->insert([
            'user_id' => $user->id,
            'item_id' => rand(1, 100)
          ]);
      }
    });
  }
}
