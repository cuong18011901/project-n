<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $guarded = [];

    public function activities() {
    	return $this->hasMany(Activity::class);
    }

    public function sponsorRatings() {
    	return $this->hasMany(SponsorRating::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
