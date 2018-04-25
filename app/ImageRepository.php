<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/04/25
 * Time: 11:25 AM
 */

namespace App;


class ImageRepository
{

    protected $image;

    function  __construct(Image $image)
    {
        $this->image = $image;

    }

    public function getImageByVenue($venue_id){

        return  $this->image->where('venue_id',$venue_id)->get();

    }

    public function save($images,$venue_id){

       foreach ($images as $image){

           $this->image->create([

                "image_id"     => $image['id'],
                "image_owner"  => $image['owner'],
                "image_secret" => $image['secret'],
                "image_server" => $image['server'],
                "image_farm"   => $image['farm'],
                "image_title"  => $image['title'],
                "venue_id"     => $venue_id

           ]);
       }
    }

}