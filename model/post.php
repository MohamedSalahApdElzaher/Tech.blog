<?php

// define post class 

class Post
{

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

    // start active record code

    static protected $database;

    static public function setDataBase($database)
    {
        return self::$database = $database;
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

    static public function countAllPosts()
    {
        $query = "SELECT * FROM posts ORDER BY p_date DESC";
        $res = self::$database->query($query);
        return $res->num_rows;
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

    public function Create()
    {
        $sql = "INSERT INTO posts (p_id, author_id, p_author, p_title, p_content, p_date, p_image, l_count, c_count)
         VALUES (null,'$this->author_id','$this->p_author', '$this->p_title', '$this->p_content', '$this->p_date', '$this->p_image' ,0,0)";
        $result = self::$database->query($sql);
        if (!$result) {
            exit("QUERY FAILED!! " . self::$database->error);
        }
        return $result;
    }

    public function Update($id)
    {
        $sql = "UPDATE posts SET p_title='$this->p_title', p_content='$this->p_content', p_image='$this->p_image' WHERE p_id='$id'";
        $result = self::$database->query($sql);
        if (!$result) {
            exit("QUERY FAILED!! " . self::$database->error);
        }
        return $result;
    }

    // end active record code


    // class consructor (empty to automatic assign args)

    public function __construct()
    {
    }

    // getters and setters

    public function setTitle($p_title)
    {
        $this->p_title = $p_title;
    }

    public function setAuthor($p_author)
    {
        $this->p_author = $p_author;
    }

    public function setAuthorId($p_author_id)
    {
        $this->author_id = $p_author_id;
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
