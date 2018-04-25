<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $guarded = [];
    protected $with    = ['location'];


    public function location(){

        return $this->belongsTo(Location::class);

    }
}
