<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function profile() {
    	return $this->belongsTo(Profile::class);
    }

    public function activity() {
    	return $this->belongsTo(Activity::class);
    }
}
