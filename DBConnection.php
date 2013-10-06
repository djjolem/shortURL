<?php

/**
    This class is for connection with database and all queries should execute trought this class. 
*/
class DBConnection {
   private $con;  

    function __construct(){
        $this->con = mysqli_connect("localhost", "short", "short", "short");
        if (mysqli_connect_error($this->con)){
            error_log ("DBConnection.php: Failed to connect to MySQL: " . mysqli_connect_error()); 
        }   
    }
    function __destruct(){
        mysqli_close($this->con); 
    }

    public function getLink($hash){
        ini_set("log_errors", 1); 
        ini_set("error_log", "./out.log"); 
        error_log("Hello, errors!"); 

        $result = mysqli_query($this->con, "SELECT * FROM short WHERE hash = '" . $hash . "';"); 
        $row = mysqli_fetch_array($result); 
        if (!is_null($row)){

            echo 'returnn ' . $row['link']; 
            return $row['link'];  
        }

        return ""; 
    }
    
    public function getLastHash(){
        $result = mysqli_query($this->con, "SELECT * FROM last_hash LIMIT 1");
        $row = mysqli_fetch_array($result);
        $last_hash = $row['last_hash'];

        return $last_hash;    
    }
    public function updateHash($hash){
        mysqli_query($this->con, "UPDATE last_hash SET last_hash = '" . $hash . "';");
    }

    public function insertNewLink($hash, $link){
        mysqli_query($this->con, "INSERT INTO short VALUES('" . $hash . "','" . $link . "');");
    }
    // if link exists in DB return hash else return ""
    public function findLink($link){
        mysqli_query($this->con, "SELECT * FROM short WHERE link = '" . $link . "';");
        $row = mysqli_fetch_array($result);
        if (!is_null($row)){
            return $row['hash']; 
        } 
    
        return "";         
    }

}
?>

