<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Lga;
use App\Model\State;

class LgaController extends Controller
{
    public function getLgas($state)
    {
    	$getState = State::where('name', $state->name)->get();
    	if ($getState) {
    		return response()->json([
    			'data' => Lga::where('state_id', $getState->id)->get(),
    			'message' => "Lgas in $state State gotten successfully!"
    		]);
    	} else {
    		return response()->json([
    			'data' => null,
    			'message' => 'State not found'
    		]);
    	}
    }
}