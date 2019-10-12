<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function activities() {
    	return $this->belongsToMany(Activity::class);
    }
}
