<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contenido =[
            [
                'nombre'=> 'ESTADOS UNIDOS',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nombre'=> 'CANADA',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nombre'=> 'MEXICO',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nombre'=> 'CHILE',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ],
            [
                'nombre'=> 'ESPAÑA',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]
        ];
        DB::table('ubicacions')->insert($contenido);
        
    }
}
