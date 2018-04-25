<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/04/24
 * Time: 4:38 PM
 */

namespace App;


class VenueRepository
{

    protected $venue;

    function __construct(Venue $venue)
    {

        $this->venue = $venue;

    }


    public function save($venues,$location_id){


        foreach ($venues as $venue){

            $this->venue->create([

                'name'          => $venue->name,
                'address'       => $venue->name,
                'lat'           => $venue->location->lat,
                'lon'           => $venue->location->lng,
                'location_id'   => $location_id

            ]);
        }

    }

    public function getVenuesByLocation($location_id){

        return  $this->venue->where('location_id',$location_id)->get();

    }

    public function find($id){

        return $this->venue->find($id);
    }



}