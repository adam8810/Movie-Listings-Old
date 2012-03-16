<?php

use Model\Playground\Apis\Rotten\Search;
use Fuel\Core\Input;

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

        $data['title'] = 'Rotten Tomatoes';


        return View::forge('playground/apis/rotten_search', $data);
    }

    public function action_add_movie($id = null)
    {
        $title = Input::get('title');
        $image = Input::get('img');
        $m_rating = Input::get('m_rating');
        $year = Input::get('year');
        $viewed = Input::get('viewed');
        $r_a_rating = Input::get('r_a_rating');
        $r_c_rating = Input::get('r_c_rating');
        $r_a_score = Input::get('r_a_score');
        $r_c_score = Input::get('r_c_score');
        $runtime = Input::get('runtime');
        $release_dvd = Input::get('release_dvd');
        $release_theater = Input::get('release_theater');

        DB::insert('movies')->set(array(
            'title' => $title,
            'image' => $image,
            'm_rating' => $m_rating,
            'MID' => $id,
            'year' => $year,
            'viewed' => $viewed,
            'r_a_rating' => $r_a_rating,
            'r_c_rating' => $r_c_rating,
            'r_a_score' => $r_a_score,
            'r_c_score' => $r_c_score,
            'movie_added' => date('Y-m-d'),
            'runtime' => $runtime,
            'release_dvd' => $release_dvd,
            'release_theater' => $release_theater
        ))->execute();
    }

    public function action_viewed($user_id = null)
    {
        // Get GET data
        $orderby = Input::get('orderby');
        $method = Input::get('method');

        $data = array();

        if ($orderby == '')
            $orderby = 'title';
        
        if ($method == '')
            $method = 'ASC';

        $data['movie'] = DB::select('title', 'runtime', 'ID', 'MID', 'year', 'image', 'm_rating')->from('movies')->where('viewed', 'like', '1', 'and', 'visible', 'like', '1')->and_where('visible', 'like', '1')->order_by($orderby, 'asc')->execute();
        $data['title'] = 'Viewed List';


        return View::forge('playground/apis/rotten_viewed', $data, false);
    }

    public function action_wishlist($user_id = null)
    {
        $data = array();

        $data['movie'] = DB::select('title', 'runtime', 'ID', 'MID', 'year', 'image', 'm_rating')->from('movies')->where('viewed', 'like', '0')->execute();

        $data['title'] = 'Wishlist';


        return View::forge('playground/apis/rotten_viewed', $data, false);
    }

    public function action_remove_movie($ID)
    {
        DB::delete('movies')->where('ID', 'like', $ID)->execute();
    }

    public function action_hide_movie($ID)
    {
        DB::update('movies')->value('visible', '0')->where('ID', 'like', $ID)->execute();
    }

    public function action_unhide_movie($ID)
    {
        DB::update('movies')->value('visible', '1')->where('ID', 'like', $ID)->execute();
    }

}