<?php
namespace Model\Playground\Apis\Rotten;

use Fuel\Core\Session;


class Sessions extends \Model
{
    public static function set_username()
    {        
        Session::set('userid', 'adam8810');
    }
    
    public static function get_username()
    {
        echo Session::get('userid');
    }
    
    public static function set_search($search_query)
    {
        // Sets the search query in the session
        Session::set('search_query', $search_query);
    }
    
    public static function get_search()
    {
        // Gets the search query in the session
        return Session::get('search_query');
    }
}