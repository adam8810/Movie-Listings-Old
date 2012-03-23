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

    public static function set_view($layout)
    {
        switch ($layout)
        {
            case 'list':
                Session::set('view', 'list');
                break;
            case 'albumList':
                Session::set('view', 'albumlist');
                break;
            case 'grid':
                Session::set('view', 'grid');
                break;
        }
    }
    
    public static function get_view()
    {
        return Session::get('view');
    }

}