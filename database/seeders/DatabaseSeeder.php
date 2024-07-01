<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();
    \App\Models\User::query()->delete();
    \App\Models\User::create([
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'phone' => '089000000000',
      'role' => 'admin',
      'password' => \Hash::make('admin')
    ]);
    \App\Models\User::create([
      'name' => 'memebr',
      'email' => 'member@gmail.com',
      'phone' => '089000000000',
      'role' => 'member',
      'password' => \Hash::make('member')
    ]);
    \App\Models\Voucher::query()->delete();
    \App\Models\Voucher::create([
      'name' => 'Voucher 1',
      'code' => 'VC1',
      'type' => 'cashback',
      'stock' => -1,
      'expired_at' => null,
      'amount' => '20',
      'amount_type' => 'percent'
    ]);
    \App\Models\Voucher::create([
      'name' => 'Voucher 2',
      'code' => 'VC2',
      'type' => 'discount',
      'stock' => -1,
      'expired_at' => null,
      'amount' => '5',
      'amount_type' => 'percent'
    ]);
  }
}
