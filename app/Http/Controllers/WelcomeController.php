<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
    public function index() {
    	if (isset(Auth::user()->sponsor)) {
    		$sponsor = Auth::user()->sponsor;

    		return view('welcome', ['sponsor' => $sponsor]);
    	}
    	elseif (isset(Auth::user()->volunteer)) {
    		$volunteer = Auth::user()->volunteer;

    		return view('welcome', ['volunteer' => $volunteer]);
    	}

    	return view('welcome');
    }
}
