<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    protected $with    = ['venue'];


    public function venue(){

        return $this->belongsTo(Venue::class);

    }
}
