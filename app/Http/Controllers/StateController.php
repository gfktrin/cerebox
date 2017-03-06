<?php

namespace Cerebox\Http\Controllers;

use Cerebox\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function getCities(State $state)
    {
    	return $state->cities;
    }
}
