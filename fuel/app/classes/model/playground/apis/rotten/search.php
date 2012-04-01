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
        $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?&page_limit=20&apikey=' . $api_key . '&q=' . str_replace(' ', '+', $keyword);

        $url = file_get_contents($url);
        $json = json_decode($url);



        // Create a new movie object for each movie returned in search
        foreach ($json->movies as $i => $movie)
        {
            // Create new movie instance
            $movie = new Movie();

            $movie->title = $json->movies[$i]->title;
            $movie->img = $json->movies[$i]->posters->detailed;
            $movie->rating = $json->movies[$i]->mpaa_rating;
            $movie->year = $json->movies[$i]->year;
            $movie->m_rating = $json->movies[$i]->mpaa_rating;
            $movie->id = $json->movies[$i]->id;
            $movie->runtime = $json->movies[$i]->runtime;

            // Ratings aren't always available, check to make sure they exist first
            if (isset($json->movies[$i]->ratings->audience_rating))
                $movie->r_a_rating = $json->movies[$i]->ratings->audience_rating;

            if (isset($json->movies[$i]->ratings->critics_rating))
                $movie->r_c_rating = $json->movies[$i]->ratings->critics_rating;

            if (isset($json->movies[$i]->ratings->audience_score))
                $movie->r_a_score = $json->movies[$i]->ratings->audience_score;

            if (isset($json->movies[$i]->ratings->critics_score))
                $movie->r_c_score = $json->movies[$i]->ratings->critics_score;

            // Release Dates
            if (isset($json->movies[$i]->release_dates->dvd))
                $movie->release_dvd = $json->movies[$i]->release_dates->dvd;

            if (isset($json->movies[$i]->release_dates->theater))
                $movie->release_theater = $json->movies[$i]->release_dates->theater;

            array_push($movie_array, $movie);
        }

        return $movie_array;
    }

    public static function box_office_listing()
    {
        $api_key = 'ggwqebk73wfqdmuk8rph3uzz';
        $url = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?apikey=' . $api_key;

        $url = file_get_contents($url);

        $json = json_decode($url);

        foreach ($json->movies as $i => $m)
        {
            echo $m->title . '- starring -';
            echo '<ul>';
            foreach ($m->abridged_cast as $a)
            {
                echo '<li>'.$a->name.'</li>';
            }
            echo '</ul>';
            echo '<br/>';
        }
    }

}