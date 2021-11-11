<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(SectoresSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(TipoParametrosSeeder::class);
        $this->call(TipoCuentaSeeder::class);
        $this->call(ParametrosSeeder::class);
        //$this->call(UserSeeder::class);
    }
}
