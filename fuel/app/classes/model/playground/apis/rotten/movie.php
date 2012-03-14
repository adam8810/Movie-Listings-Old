<?php

namespace Model\Playground\Apis\Rotten;

use Model\Playground\Apis\Rotten\Review;

class Movie extends \Model {

    // $title = null, $year = null, $img = null, $r_rating = null, $m_rating = null, $r_rating_crit = null, $id = null,
    //        $release_dvd = null, $release_theater = null, $reviews = null, $synopsis = null, $runtime = null, $cast = null


    function __construct()
    {
        
    }

    public function set_vars($title = null, $year = null, $img = null, $r_rating = null, $m_rating = null, $r_rating_crit = null, $id = null, $release_dvd = null, $release_theater = null, $reviews = null, $synopsis = null, $runtime = null, $cast = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->runtime = $runtime;
        $this->synopsis = $synopsis;
        $this->img = $img;

        // Ratings
        $this->m_rating = $m_rating;
        $this->r_rating = $r_rating;
        $this->r_rating_crit = $r_rating_crit;

        // Release Dates
        $this->release_dvd = $release_dvd;
        $this->release_theater = $release_theater;
        $this->cast = $cast;

        // Reviews
        $this->reviews = $reviews;
    }

}