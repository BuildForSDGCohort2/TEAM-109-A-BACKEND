<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Country;

class CountryController extends Controller
{
    public function getCountries(){
        return response()->json([
            'data'=> Country::all(),
            'message'=>'All countries gooten Succesfully'
        ]);
    }
}