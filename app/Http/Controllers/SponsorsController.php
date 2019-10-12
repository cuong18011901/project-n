<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorsController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function new_index() {
    	return view('new_activity');
    }
}
