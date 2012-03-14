<?php

namespace Model\Playground\Apis\Rotten;

class Character extends \Model
{
    function __construct($name = null, $characters = null)
    {
        $this->name = $name;
        $this->characters = $characters; // Array of 1 or more character roles in a movie
    }
    
    
}