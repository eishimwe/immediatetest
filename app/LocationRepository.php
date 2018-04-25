<?php
namespace App;

class LocationRepository
{

    protected $location;


    function __construct(Location $location)
    {
        $this->location = $location;

    }

    public function getLocations(){

        return $this->location->latest();

    }



    public function getLocation($location){

        $location = $this->location->search($location['location'])->first();

        if($location) return $location;


        //return $this->location->search($location['gps'])->first();

    }


    public function save($location){

        return $this->location->create(['name' => $location['location'],'gps' => $location['gps']]);

    }





}