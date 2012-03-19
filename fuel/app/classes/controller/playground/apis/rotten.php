<?php

use \Fuel\Core;
use \Fuel\Core\Session;
use Model\Playground\Apis\Rotten\Search;
use Model\Playground\Apis\Rotten\Movie;
use Model\Playground\Apis\Rotten\Sessions;
use Fuel\Core\Input;

class Controller_Playground_Apis_Rotten extends Controller {

    function before()
    {
        if (Input::GET('title') != '')
        {
            $this->title = Input::GET('title');
        }
        else if (Sessions::get_search() != '')
        {
            $this->title = Sessions::get_search();
        }
    }

    function action_index()
    {
        $data['title'] = 'Search Rotten Tomatoes';
        $data['movie'] = null;

        return View::forge('playground/apis/list_view', $data);
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

        $data['control_action'] = 'add';


        return View::forge('playground/apis/list_view', $data);
    }

    public function action_Add_movie($id = null)
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

        $result = DB::select('title', 'runtime', 'ID', 'MID', 'year', 'image', 'm_rating', 'our_rating')->from('movies')->where('viewed', 'like', '1')->and_where('visible', 'like', '1')->order_by($orderby, $method)->execute();
        $data['title'] = 'Viewed List';
        $data['movie'] = array();
        $data['control_action'] = 'remove';

        foreach ($result as $r)
        {
            $movie = new Movie();

            $movie->title = $r['title'];
            $movie->runtime = $r['runtime'];
            $movie->id = $r['ID'];
            $movie->MID = $r['MID'];
            $movie->year = $r['year'];
            $movie->img = $r['image'];
            $movie->our_rating = $r['our_rating'];
            $movie->m_rating = $r['m_rating'];
            $movie->r_a_score = null;
            $movie->r_c_score = null;

            array_push($data['movie'], $movie);
        }




        return View::forge('playground/apis/list_view', $data, false);
    }

    public function action_wishlist($user_id = null)
    {
        $data = array();

        $data['movie'] = DB::select('title', 'runtime', 'ID', 'MID', 'year', 'image', 'm_rating')->from('movies')->where('viewed', 'like', '0')->and_where('visible', 'like', '1')->execute();

        $data['title'] = 'Wishlist';

        $data['control_action'] = 'remove';


        return View::forge('playground/apis/list_view', $data, false);
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

    // Following functions for session mgmt
    public function action_setusername()
    {
        Sessions::set_username();
    }

    public function action_getusername()
    {
        Sessions::get_username();
    }

}