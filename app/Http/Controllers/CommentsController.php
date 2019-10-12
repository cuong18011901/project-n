<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function store(Request $request) {
    	$data = $request->validate([
    		'comment' => ['required'],
    		'activity_id' => ['required'],
    		'profile_id' => ['required'],
    	]);

    	$comment = \App\Comment::create([
    		'content' => $request->comment,
    		'activity_id' => $request->activity_id,
    		'profile_id' => $request->profile_id,
    	]);

    	return back();
    }
}
