<html>
<head>
</head>

<body>
    <h5>Creating hash for link:</h5><br />
    <?php 
        include 'DBConnection.php'; 
        $model = new DBConnection;         

        function next_char($ch){    
            if ($ch == '9'){
                return 'A'; 
            }
            if ($ch == 'Z'){
                return 'a'; 
            }
            if ($ch == 'z'){
                return '0'; 
            }
            return chr(ord($ch) + 1); 
        }

        function next_hash($last){
            $chars = str_split($last); 

            $ind = count($chars) - 1; 
            $ch = $chars[$ind]; 
            $ch = next_char($ch); 

            $chars[$ind] = $ch; 
            while ($ch == 'A' || $ch == 'a' || $ch == '0'){
                $ind--; 
                if ($ind < 0) {
                    if ($ch == '0'){ 
                        $new_array = array_merge(['0'], $chars); 
                        return implode("", $new_array); 
                    } else {
                        return implode("", $chars); 
                    } 
                } 
 
                $ch = next_char($chars[$ind]); 
                $chars[$ind] = $ch; 
            }
            
            return implode("", $chars); 
        }

        $site = "go.it";  
        $link = $_POST["link"]; 

        $hash = $model->findLink($link); 
        // check does link exist in DB 
        if ($hash == ""){
            // link doesn't exist in database - create and  insert it
            $last_hash = $model->getLastHash();  
            $hash = next_hash($last_hash);  
    
            // insert into DB and update last_hash
            $model->updateHash($hash); 
            $model->insertNewLink($hash, $link); 
        }
        
        echo "<br />Your link is: " . $site .'/'. $hash; 
    ?>

    <br /><br />
    <a href="./index.php"> Generate another hash </a>
    
</body>
</html>

