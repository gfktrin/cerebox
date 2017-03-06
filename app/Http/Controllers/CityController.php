<?php

namespace Cerebox\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function retrieve(City $city)
    {
    	return $city;
    }
}
