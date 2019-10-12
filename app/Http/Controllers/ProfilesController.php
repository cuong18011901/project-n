<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfilesController extends Controller
{
    public function index($profile_id) {
    	$profile = \App\Profile::findOrFail($profile_id);
    	$user = $profile->user;

    	$toView = array(
    		'profile' => $profile,
    		'user' => $user,
    	);

    	$auth = Auth::user();

    	if ($auth) {
    		$toView = array_merge($toView, ['auth' => $auth,]);
    	}

    	if ($user->type === 1) {
    		$sponsor = $user->sponsor;
    		$ratings = $sponsor->sponsorRatings()->orderBy('created_at', 'DESC')->paginate(3);
    		$activities = $sponsor->activities;
    		$finished = $activities->where('status', 'finished');
    		$ongoing = $activities->where('status', 'on going');

    		$toView = array_merge(
    			$toView,
    			[
    				'sponsor' => $sponsor,
    				'ratings' => $ratings,
    				'activities' => $activities,
    				'finished' => $finished,
    				'ongoing' => $ongoing,
    			]
    		);

	    	if (!$auth || ($auth && $auth->profile->id !== $profile->id)) {
	    		$toView = array_merge($toView, ['show_rate' => true,]);
	    	}

	    	if ($auth) {
	    		$sponsor_rating = $sponsor->sponsorRatings->where('profile_id', $auth->profile->id);
	    		if ($sponsor_rating->count() !== 0)
	    		$toView = array_merge($toView, [
	    			'already_rated' => true,
	    			'sponsor_rating' => $sponsor_rating->first(),
	    		]);
	    	}
    	}
    	else {
    		$volunteer = $user->volunteer;
    		$activities = $volunteer->activities;
    		$ratings = $volunteer->ratings;
    		$finished = $activities->where('status', 'finished');
    		$ongoing = $activities->where('status', 'on going');

    		$toView = array_merge(
    			$toView,
    			[
    				'volunteer' => $volunteer,
    				'activities' => $activities,
    				'ratings' => $ratings,
    				'finished' => $finished,
    				'ongoing' => $ongoing,
    			]
    		);
    	}

    	return view('profile', $toView);
    }
}
