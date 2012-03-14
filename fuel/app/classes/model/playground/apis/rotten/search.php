<?php

namespace Model\Playground\Apis\Rotten;

use Model\Playground\Apis\Rotten\Character;
use Model\Playground\Apis\Rotten\Movie;

//use 

class Search extends \Model {

    function __construct($title)
    {
        return $this->return_result($title);
    }

    public function return_result($keyword)
    {
        $movie = array();
        $movie_array = array();


        $api_key = 'ggwqebk73wfqdmuk8rph3uzz';
        $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $api_key . '&q=' . str_replace(' ', '+', $keyword);

        $url = file_get_contents($url);
        $json = json_decode($url);



        // Create a new movie object for each movie returned in search
        foreach ($json->movies as $i => $movie)
        {
            // Create new movie instance
            $movie = new Movie();

            $movie->title = $json->movies[$i]->title;
            $movie->img = $json->movies[$i]->posters->original;
            $movie->rating = $json->movies[$i]->mpaa_rating;
            $movie->year = $json->movies[$i]->year;
            $movie->m_rating = $json->movies[$i]->mpaa_rating;
            $movie->id = $json->movies[$i]->id;
//            $movie->r_rating_aud = $json->movies[$i]->ratings->audience_rating;
//            $movie->r_rating_crit = $json->movies[$i]->ratings->critics_rating;
            
            
            array_push($movie_array, $movie);
        }
        
        return $movie_array;
    }

}