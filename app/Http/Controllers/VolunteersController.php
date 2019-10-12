<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VolunteersController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function store(Request $request) {
    	$data = $request->validate([
    		'partake_id' => ['required'],
    	]);

    	$activity = \App\Activity::find($data['partake_id']);
    	
    	if ($activity->status === 'finished') {	
    		return back()->with('error_message', 'Activity has already ended');
    	}
    	else {
    		$vol = Auth::user()->volunteer;
    		if ($vol->activities->contains($data['partake_id'])) {
    			$message = 'Activity ' . strtoupper($activity->title) . ' already signed';
    			return back()->with('error_message', $message);
    		}
    		else {
	    	   	$vol->activities()->attach($data['partake_id']);
		    	$activity->concern += 1;
		    	$activity->save();
		    }

	    	$message = 'Successfully registered for ' . strtoupper($activity->title) . '!';
    		return back()->with('success_message', $message);
    	}
    }

    public function destroy(Request $request) {
    	$data = $request->validate([
    		'remove_id' => ['required'],
    	]);

    	$activity = \App\Activity::find($data['remove_id']);

    	if ($activity->status === 'finished') {
    		return back()->with('error_message', 'Activity has already ended');
    	}
    	else {
    		$vol = Auth::user()->volunteer;

    		if ($vol->activities->contains($data['remove_id'])) {
	    	   	$vol->activities()->detach($data['remove_id']);
		    	$activity->concern -= 1;
		    	$activity->save();
		    	$vol->rating -= 3;
		    	$vol->save();
    		}
    		else {
    			$message = 'Activity ' . strtoupper($activity->title) . ' not signed, cannot quit';
    			return back()->with('error_message', $message);
    		}

	    	$message = 'Successfully unregistered for ' . strtoupper($activity->title) . ', rating has been decreased!';
    		return back()->with('warning_message', $message);
    	}

    	return back();
    }
}
