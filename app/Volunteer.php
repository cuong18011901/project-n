<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = [];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function activities() {
    	return $this->belongsToMany(Activity::class);
    }

    public function ratings() {
    	return $this->hasMany(Rating::class);
    }
}
