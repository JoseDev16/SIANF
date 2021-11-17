<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sectores = [
            ["Electrónicos"],
            ["Ropa"],
        ];

        foreach($sectores as $sector){
            Sector::create(['nombre' => $sector[0]]);
        } 
    }
}
