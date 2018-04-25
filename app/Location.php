<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function scopeSearch($query, $search)
    {
        $search = trim($search);

        return $query->where(function($query) use ($search)
        {

            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('gps', 'LIKE', "%$search%");


        });
    }


    public function venues(){

        return $this->hasMany(Venue::class);

    }


}
