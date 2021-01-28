<?php

use App\User;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'JOSUE',
            'email' => 'josueperezf@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://www.facebook.com/josueperezf/',
        ]);

        $user2 = User::create([
            'name' => 'MAGDALENA',
            'email' => 'magdalena@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://www.facebook.com/josueperezf2/',
        ]);
    }
}
