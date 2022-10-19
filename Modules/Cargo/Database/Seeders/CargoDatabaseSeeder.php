<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CargoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
    }
}
