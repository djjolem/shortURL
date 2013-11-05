<?php

require('config.php');

/**
    This class is for connection with database and all queries should execute trought this class.
*/
class DBConnection {
   private $con;

    function __construct(){
        $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_error($this->con)){
            error_log ("DBConnection.php: Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }
    function __destruct(){
        mysqli_close($this->con);
    }

    public function getLink($hash){
        $id = base_convert($hash, 36, 10);

        $result = mysqli_query($this->con, "SELECT * FROM " . DBT_URL . " WHERE id = '$id';");
        $row = mysqli_fetch_array($result);
        if (!is_null($row)){
            return $row['link'];
        }

        return "";
    }


    public function insertNewLink($link){
        mysqli_query($this->con, "INSERT INTO " . DBT_URL . " (link) VALUES('" . $link . "');");
        return mysqli_insert_id($this->con);
    }

    // if link exist in DB return ID -
    public function findLink($link){
        $result = mysqli_query($this->con, "SELECT * FROM " . DBT_URL . " WHERE link = '" . $link . "';");
        $row = mysqli_fetch_array($result);
        if (!is_null($row)){
            return $row['id'];
        }

        return "";
    }
    

    public function doesExistUser($user, $pass){
        $result = mysqli_query($this->con, "SELECT * FROM " . DBT_USER . 
            " WHERE username = '$user' and password = '$pass';");
        $row = mysqli_fetch_array($result); 
        if  (!is_null($row)){   
            // check does returned values match user and pass 
            if ($row['username'] == $user && $row['password'] == $pass){
                return true; 
            } 
        }
        
        return false; 
    }
}
?>

