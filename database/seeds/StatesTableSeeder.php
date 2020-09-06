<?php

use Illuminate\Database\Seeder;
use App\Model\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$states = ['Abia', 'Adamawa', 'Akwa-Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross-River', 'Delta', 'Ebonyi', 'Edo', 'Enugu', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nassarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara', 'Abuja'];
    	
    	foreach ($states as $state) {
    		State::create([
	        	'name' => $state,
	        	'country_id' => 1,
	        ]);
    	}
    }
}
