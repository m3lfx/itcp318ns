<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'user 1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
            ]);
    }
}
