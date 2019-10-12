<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingsController extends Controller
{
    //
	public function store(Request $request) {
		$data = $request->all();

		$act = \App\Activity::findOrFail($data['activity_id']);

		if ($act->status === 'finished') {
			return back()->with('error_message', 'Activity already finished and all volunteers rated');
		}
		else {
			foreach ($data['rate'] as $rate) {
				$vol = \App\Volunteer::find($rate['volunteer_id']);
				$tags = $data['tags'];
				// dd($tags);
				if ($vol->activities->contains($data['activity_id'])) {
					\App\Rating::create([
						'volunteer_id' => $rate['volunteer_id'],
						'activity_id' => $data['activity_id'],
						'sponsor_id' => $rate['sponsor_id'],
						'rating' => $rate['rating'],
						'comment' => $rate['comment'],
					]);

					$vol->rating += floatval($rate['rating']);
					foreach ($tags as $key => $tag) {
						if (intval($tag) === 1) $vol->cleanning += 1;
						if (intval($tag) === 2) $vol->helping += 1;
						if (intval($tag) === 3) $vol->building += 1;
					}
					$vol->save();
				}
			}

			$act->status = 'finished';
			$act->save();

			$message = 'Activity ' . strtoupper($act->title) . ' successfully finished and all volunteers rated';
			return back()->with('success_message', $message);			
		}
	}

    public function update() {

    }

    public function destroy() {
    	
    }
}
