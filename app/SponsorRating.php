<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorRating extends Model
{
    protected $guarded = [];

    public function profile() {
    	return $this->belongsTo(Profile::class);
    }

    public function sponsor() {
    	return $this->belongsTo(Sponsor::class);
    }
}
