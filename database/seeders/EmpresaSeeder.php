<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $empresas = [
            ["Pull & Bear","645123-6","44165158", 2,"pull&bear", "empresa"],
            ["Zara","946423-7","69328758", 1, "zara", "empresa"],
            ["Electrónica Japonesa","645165-7","44165158", 1, "electronicajaponesa",  "empresa"],
            ["Radio Shack","060499-2","46516519", 1, "radioshack", "empresa"],
        ];

        foreach($empresas as $empresa){
            $empre = Empresa::create(['nombre' => $empresa[0],
                                        'nit' => $empresa[1],
                                        'nrc' => $empresa[2],
                                        'sector_id' => $empresa[3]]);

            $user = User::create([  'name' => $empresa[0],
                            'email' => $empresa[4].'@gmail.com',
                            'username' => $empresa[4],
                            'password' => Hash::make($empresa[5])]);
            $user->assignRole('empresa');

            $empre->user_id = $user->id;
            $empre->save();
        } 
    }
}
