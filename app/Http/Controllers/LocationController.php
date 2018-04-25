<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocationRepository;
use App\VenueRepository;
use Iivannov\Larasquare\Facade\Larasquare;
use JeroenG\Flickr\FlickrLaravelFacade as Flickr;
use App\ImageRepository;
use Illuminate\Support\Facades\Redirect;



class LocationController extends Controller{

    protected $location,$venue,$image;

    public function __construct(LocationRepository $location,VenueRepository $venue,ImageRepository $image)
    {
        $this->location = $location;
        $this->venue    = $venue;
        $this->image    = $image;
    }


    public function index(){

        $venues = [];
        return view('location.list',compact('venues'));

    }


    public function find(Request $request){


        $location = $this->location->getLocation($request->all());

        $venues = [];


        if($location){

            $venues = $this->venue->getVenuesByLocation($location->id);

            return View('location.list',compact('venues'));

        }else{

            try {

                $venues = Larasquare::venues(['near' => $request['location']]);
            }
            catch (\Exception $e) {

                return View('location.list',compact('venues'))->with('message','No results found!');

            }

            //Save location
            $location = $this->location->save($request->all());







            //Save venues location
            $this->venue->save($venues,$location->id);

            $venues = $this->venue->getVenuesByLocation($location->id);


            return View('location.list',compact('venues'));


        }



    }

    public function getLocationImages($location,$venue_id){

       $venue  = $this->venue->find($venue_id);

       $images = $this->image->getImageByVenue($venue_id);

       if($images->isEmpty()){


           $params = [

               "lat"     => $venue->lat,
               'lon'     => $venue->lon,

           ];

           //Check images via API
           $result = Flickr::request('flickr.photos.search',$params);

           if($result){

               $this->image->save($result->photos['photo'],$venue_id);



           }


           $images = $this->image->getImageByVenue($venue_id);

       }

        return View('location.images',compact('images','location'));



    }
}
