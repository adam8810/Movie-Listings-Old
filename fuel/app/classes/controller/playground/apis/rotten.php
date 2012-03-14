<?php

use Model\Playground\Apis\Rotten\Search;

class Controller_Playground_Apis_Rotten extends Controller {

    function before()
    {
        $this->title = Input::GET('title');
    }

    function action_index()
    {
        $data['title'] = 'Search Rotten Tomatoes';
        $data['movie'] = null;

        return View::forge('playground/apis/rotten_search', $data);
    }

    public function action_search()
    {
        $data = array();

        if ($this->title != "")
        {
            $search = new Search($this->title);

            $results = $search->return_result($this->title);
            $data['movie'] = $results;
        }
        else
            $data['movie'] = null;
        


//
//        $data['original_img'] = $listing->img;
        $data['title'] = 'Rotten Tomatoes';
//        $data['rating'] = $listing->rating;
//        $data['year'] = $listing->year;
//
//
//        $data['cast_characters'] = $listing->cast_characters;
//        $data['cast_actors'] = $listing->cast_names;



        return View::forge('playground/apis/rotten_search', $data);
    }

    public function action_add_movie($id = null)
    {
        echo 'id= ' . $id;
        $title = Input::get('title');
        $image = Input::get('img');
        $m_rating = Input::get('m_rating');
        $year = Input::get('year');
        $viewed = Input::get('viewed');

        DB::insert('movies')->set(array(
            'title' => $title,
            'image' => $image,
            'm_rating' => $m_rating,
            'MID' => $id,
            'year' => $year,
            'viewed' => $viewed
        ))->execute();
    }

    public function action_viewed($user_id = null)
    {
        $data = array();

        $data['movie'] = DB::select('title', 'ID', 'MID', 'year', 'image', 'm_rating')->from('movies')->where('viewed','like','1')->execute();

        $data['title'] = 'Viewed List';


        return View::forge('playground/apis/rotten_viewed', $data, false);
    }
    
    public function action_wishlist($user_id = null)
    {
        $data = array();

        $data['movie'] = DB::select('title', 'ID', 'MID', 'year', 'image', 'm_rating')->from('movies')->where('viewed','like','0')->execute();

        $data['title'] = 'WishList';


        return View::forge('playground/apis/rotten_viewed', $data, false);
    }

    public function action_remove_movie($ID)
    {
        DB::delete('movies')->where('ID', 'like', $ID)->execute();
    }

}