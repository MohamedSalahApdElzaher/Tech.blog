<?php

// define post class 

class Comment
{

    // class attributes

    private $p_id;
    private $author;
    private $comment;
    private $date;


    // class consructor

    public function __construct($p_id, $author, $comment, $date)
    {
        $this->p_id = $p_id;
        $this->author = $author;
        $this->comment = $comment;
        $this->date = $date;
    }

    // getters and setters

    public function setP_id($p_id)
    {
        $this->p_id = $p_id;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    public function getP_id()
    {
        return $this->p_id;
    }

    public function getAuthor()
    {
        return $this->author;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getComment()
    {
        return $this->comment;
    }
}
