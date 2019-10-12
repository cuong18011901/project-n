<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function sponsor() {
    	return $this->belongsTo(Sponsor::class);
    }

    public function volunteers() {
    	return $this->belongsToMany(Volunteer::class);
    }

    public function comments() {
    	return $this->hasMany(Comment::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
