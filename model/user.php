<?php

// define post class 

class User
{

    // start active record code

    static protected $database;

    static public function setDatabase($database)
    {
        return self::$database = $database;
    }

    // get user by his unique email

    static public function get_by_email($user_email)
    {
        $sql = "SELECT * FROM users WHERE email='$user_email'";
        $result = self::$database->query($sql);
        if (!$result) {
            exit("QUERY FAILD!!");
        }
        $arr_object = [];
        while ($record = $result->fetch_assoc()) {
            $arr_object[] = self::instantiate($record);
        }
        $result->free();
        return $arr_object;
    }

    static public function instantiate($record)
    {
        $object = new self;
        foreach ($record as $property => $val) {
            if (property_exists($object, $property)) {
                $object->$property = $val;
            }
        }
        return $object;
    }



    // end active record code

    // class attributes

    private $id;
    private $user_name;
    private $email;
    private $password;
    private $joined;



    // class consructor

    public function __construct()
    {
    }

    /*
    public function __construct($user_name, $email, $password, $joined)
    {
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
        $this->joined = $joined;
    }
    */

    // getters and setters

    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPass($pass)
    {
        $this->password = $pass;
    }
    public function setDate($joined)
    {
        $this->joined = $joined;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUserName()
    {
        return $this->user_name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getDate()
    {
        return $this->joined;
    }
}
