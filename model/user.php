<?php

// define post class 

class User
{

    // class attributes

    private $id;
    private $user_name;
    private $email;
    private $password;
    private $joined;

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
            exit("QUERY FAILD!!" . self::$database->error);
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

    // add new record to database

    public function create()
    {
        $sql = "INSERT INTO users (id,user_name, email, password, joined)
               VALUES(null,'$this->user_name', '$this->email', '$this->password', '$this->joined')";
        $result = self::$database->query($sql);
        return $result;
    }

    public function update($email)
    {
        $sql = "UPDATE users SET user_name='$this->user_name', password='$this->password' WHERE email = '$email'";
        $result = self::$database->query($sql);
        if(!$result){exit("QUERY FAILED ".self::$database->error);}
        return $result;
    }



    // end active record code

    // class consructor

    public function __construct()
    {
    }

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
