<?php

// define post class 

class Post
{
    // start active record code

    static protected $database;

    static public function setDataBase($database)
    {
        self::$database = $database;
    }

    // get a sql record

    static public function get_post_by_sql($sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("DATABASE FAILED !!");
        }
        // convert result into objects
        $arr_object = [];
        while ($record = $result->fetch_assoc()) {
            $arr_object[] = self::instantiate($record);
        }

        $result->free();
        return $arr_object;
    }

    // get all posts records order by date

    static public function getAllPosts()
    {
        $query = "SELECT * FROM posts ORDER BY p_date DESC";
        return self::get_post_by_sql($query);
    }

    // automatic assign args here

    static protected function instantiate($record)
    {
        $object = new self;

        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    // end active record code

    // class attributes

    private $p_id;
    private $author_id;
    private $p_title;
    private $p_author;
    private $p_date;
    private $p_image;
    private $p_content;
    private $l_count;
    private $c_count;


    // class consructor (empty to automatic assign args)

    public function __construct()
    {
    }

    /*
    public function __construct($author_id, $p_title, $p_author, $p_date, $p_image, $p_content, $l_count, $c_count)
    {
        $this->author_id = $author_id;
        $this->p_title = $p_title;
        $this->p_author = $p_author;
        $this->p_date = $p_date;
        $this->p_image = $p_image;
        $this->p_content = $p_content;
        $this->l_count = $l_count;
        $this->c_count = $c_count;
    }
    */

    // getters and setters

    public function setTitle($p_title)
    {
        $this->p_title = $p_title;
    }

    public function setAuthor($p_author)
    {
        $this->p_author = $p_author;
    }

    public function setDate($p_date)
    {
        $this->p_date = $p_date;
    }

    public function setImage($p_image)
    {
        $this->p_image = $p_image;
    }

    public function setContent($p_content)
    {
        $this->p_content = $p_content;
    }

    public function setL_count($l_count)
    {
        $this->l_count = $l_count;
    }

    public function setC_count($c_count)
    {
        $this->c_count = $c_count;
    }

    public function getTitle()
    {
        return $this->p_title;
    }
    public function getAuthor_id()
    {
        return $this->author_id;
    }
    public function getId()
    {
        return $this->p_id;
    }

    public function getAuthor()
    {
        return $this->p_author;
    }
    public function getDate()
    {
        return $this->p_date;
    }
    public function getImage()
    {
        return $this->p_image;
    }
    public function getContent()
    {
        return $this->p_content;
    }
    public function getL_count()
    {
        return $this->l_count;
    }
    public function getLC_count()
    {
        return $this->c_count;
    }
}
