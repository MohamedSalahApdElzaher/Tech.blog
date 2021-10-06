<?php

// define post class 

class Categries
{

    // class attributes

    private $title;


    // class consructor

    public function __construct($title)
    {
        $this->title = $title;
    }

    // getters and setters

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
