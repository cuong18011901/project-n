<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];

    public function volunteer() {
    	return $this->belongsTo(Volunteer::class);
    }

    public function activity() {
    	return $this->belongsTo(Activity::class);
    }
}
