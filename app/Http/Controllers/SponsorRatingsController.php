<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SponsorRatingsController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function store(Request $request) {

    	$data = $request->validate([
    		'rating' => ['required', 'numeric', 'between:1,5'],
            'sponsor_id' => 'required',
            'comment' => '',
    	]);

    	$profile = Auth::user()->profile;
    	$sponsor = \App\Sponsor::find($data['sponsor_id']);

    	if ($profile->id === $data['sponsor_id']) {
    		return back()->with('error_message', 'Cannot rate yourself');
    	}
    	else if ($sponsor->sponsorRatings->where('profile_id', $profile->id)->count() !== 0) {
    		return back()->with('error_message', 'You already rated this sponsor');
    	}
    	else {
    		\App\SponsorRating::create([
    			'profile_id' => $profile->id,
    			'sponsor_id' => $data['sponsor_id'],
    			'rating' => $data['rating'],
    			'comment' => $data['comment'],
    		]);

            $rating = \App\SponsorRating::where('sponsor_id', $data['sponsor_id'])->sum('rating');
            $sponsor->update(['rating' => $rating]);

            return back()->with('success_message', 'Sponsor successfully rated');
    	}
    }

    public function update(Request $request) {
        $data = $request->validate([
            'rating' => ['required', 'numeric', 'between:1,5'],
            'sponsor_id' => 'required',
            'comment' => '',
        ]);

        $sponsor = \App\Sponsor::findOrFail($data['sponsor_id']);

        $profile = Auth::user()->profile;

        $sponsor_rating = \App\SponsorRating::where([
            ['profile_id', '=', $profile->id],
            ['sponsor_id', '=', $data['sponsor_id']],
        ]);

        if ($sponsor_rating->count() === 0) {
            return back()->with('error_message', 'Record not found');
        }
        else {
            $sponsor_rating = $sponsor_rating->first();
            $sponsor_rating->update([
                'comment' => $data['comment'],
                'rating' => floatval($data['rating']),
            ]);

            $rating = \App\SponsorRating::where('sponsor_id', $data['sponsor_id'])->sum('rating');
            $sponsor->update(['rating' => $rating]);

            return back()->with('success_message', 'Rating successfully updated');
        }

    }
}
