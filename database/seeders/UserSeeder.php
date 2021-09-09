<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seed
     * @return void
     */
    public function run()
    {
        $mg = User::create([
            'name' => 'GodMode',
            'email' => 'playersrebirth@gmail.com',
            'password' => Hash::make('shosa2021##'),
        ]);

        $webeffective = User::create([
            'name' => 'Web Effective',
            'email' => 'webeffect94@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $shosa = User::create([
            'name' => 'Shosa Admin',
            'email' => 'shosaempire@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}