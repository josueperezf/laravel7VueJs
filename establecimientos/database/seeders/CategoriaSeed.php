<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeed extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre'       => 'Restaurant',
            'slug'         => Str::slug('Restaurant'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Cafe',
            'slug'         => Str::slug('Cafe'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Hotel',
            'slug'         => Str::slug('Hotel'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Bar',
            'slug'         => Str::slug('Bar'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Hospitales',
            'slug'         => Str::slug('Hospitales'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Gimnasio',
            'slug'         => Str::slug('gimnasio'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
        DB::table('categorias')->insert([
            'nombre'       => 'Doctor',
            'slug'         => Str::slug('Doctor'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
