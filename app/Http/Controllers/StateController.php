<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\State;
use App\Model\Country;

class StateController extends Controller
{
    public function getStates($country){
    	$getCountry = Country::where('name', $country)->first();
    	if ($getCountry) {
    		return response()->json([
	            'data'=> State::where('country_id', $getCountry->id)->get(),
	            'message' => 'All countries gotten Succesfully'
	        ]);
    	} else {
    		return response()->json([
    			'data' => null,
    			'message' => 'Country not found'
    		]);
    	}
    }
}