<?php

/**
    This class is for connection with database and all queries should execute trought this class.
*/
class DBConnection {
   private $con;

    function __construct(){
        $this->con = mysqli_connect("127.10.30.130", "short", "short", "short");
        if (mysqli_connect_error($this->con)){
            error_log ("DBConnection.php: Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }
    function __destruct(){
        mysqli_close($this->con);
    }

    public function getLink($hash){
        $id = base_convert($hash, 36, 10);

        $result = mysqli_query($this->con, "SELECT * FROM short WHERE id = '$id';");
        $row = mysqli_fetch_array($result);
        if (!is_null($row)){
            return $row['link'];
        }

        return "";
    }


    public function insertNewLink($link){
        mysqli_query($this->con, "INSERT INTO short (link) VALUES('" . $link . "');");
        return mysqli_insert_id($this->con);
    }

    // if link exist in DB return ID -
    public function findLink($link){
        $result = mysqli_query($this->con, "SELECT * FROM short WHERE link = '" . $link . "';");
        $row = mysqli_fetch_array($result);
        if (!is_null($row)){
            return $row['id'];
        }

        return "";
    }
    

    public function doesExistUser($user, $pass){
        return true; 
    }
}
?>

