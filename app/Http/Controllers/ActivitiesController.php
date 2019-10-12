<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image as Image;
use Auth;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index($activity_id) {
    	$activity = \App\Activity::findOrFail($activity_id);
    	$comments = \App\Comment::where('activity_id', $activity_id)->orderBy('created_at','DESC')->paginate(3);
    	$volunteers = $activity->volunteers;
    	$ratings = $activity->ratings;

    	$toView = array(
    		'activity' => $activity,
    		'comments' => $comments,
    		'volunteers' => $volunteers,
    		'ratings' => $ratings,
    	);

    	if (Auth::user()) {
    		if (Auth::user()->volunteer) {
    			$toView = array_merge(
    				$toView,
    				['volunteer' => Auth::user()->volunteer]
    			);
    		}
    		elseif (Auth::user()->sponsor) {
    			$sponsor = Auth::user()->sponsor;
    			$holding = $sponsor->activities->contains($activity_id);

    			$toView = array_merge(
    				$toView,
    				[
    					'sponsor' => $sponsor,
    					'holding' => $holding,
    				]
    			);
    		}
    	}

    	return view('activity', $toView);
    }

    public function store(Request $request) {
    	$data = $request->validate([
    		'title' => ['required', 'unique:activities'],
    		'description' => ['required'],
    		'start' => ['required', 'date'],
    		'budget' => ['required', 'numeric', 'min:0'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
    		'image' => ['required', 'image'],
    	]);

        $tags = array_diff_key($request->all(),[ 
            'title' => '', 
            '_token' => '', 
            '_method' => '', 
            'description' => '', 
            'start' => '', 
            'budget' => '',
            'image' => '',
            'lat' => '',
            'lng' => '',
        ]);

    	$path = $request->image->store('img', 'public');
    	$image = Image::make(public_path("storage/{$path}"))->fit(800,800);

    	$image->save();

    	array_pop($data);

    	$act = \App\Activity::create(array_merge(
    		$data,
    		[
    			'image' => $path,
    			'sponsor_id' => Auth::user()->sponsor->id,
    		]
    	));

        $act->tags()->attach($tags);

    	return redirect()->route('welcome');
    }
}
