<?php

use Illuminate\Database\Seeder;
use App\Model\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
        	'name' => 'Nigeria',
        	'id' => 1,
        ]);
    }
}
