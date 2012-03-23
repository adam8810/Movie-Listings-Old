<?php

namespace Model\Playground\Apis\Rotten;

use Fuel\Core\Session;

class Sessions extends \Model {

    public static function set_search($search_query)
    {
        echo 'query_search = ' . $search_query;
        // Sets the search query in the session
        Session::set('search_query', $search_query);
    }

    public static function get_search()
    {
        if (Session::get('search_query'))
        {
            // Gets the search query in the session
            return Session::get('search_query');
        }
        else
            return false;
    }

}