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
        $this->call(PermissionsTableSeeder::class);
        $this->call(TipoParametrosSeeder::class);
        $this->call(TipoCuentaSeeder::class);
        $this->call(ParametrosSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(PeriodoSeeder::class);
        $this->call(CuentaSeeder::class);
        $this->call(CuentaPeriodoSeeder::class);
        $this->call(BalanceGeneralSeeder::class);
        $this->call(EstadoResultadoSeeder::class);
        //$this->call(UserSeeder::class);
    }
}
