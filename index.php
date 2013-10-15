<html>
<head>
</head>

<body>
    <h5>Create short link</h5>
    
    <?php 
        include 'DBConnection.php'; 

        $hash = $_GET["hash"]; 
        if (isset($hash)){
            $model = new DBConnection; 
            $link = $model->getLink($hash); 
            echo 'Go to link: ' . $link;         
       

            if ($link != ""){ 
                header("Location: " . 'http://'. $link); 
            } else {
                echo '<div> Cant find link with hash: ' . $hash . ' </div>'; 
            }
        } else {
        ?>

        <form action="generate.php" method="post" >
            Link: <input type="text" name="link" autofocus="autofocus" />
            <input type="submit" value="Creat" />
        </form>
        <?php } ?> 
</body>
</html>

