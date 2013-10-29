<html>
<head>
    <title> Link to ... </title>
    <meta name="description" content="Link shortener"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<?php
    // redirect to another site
    include 'DBConnection.php';
    $model = new DBConnection; 

    $hash = $_GET["hash"];
    if (isset($hash)){
        $link = $model->getLink($hash);
        echo 'Go to link: ' . $link;

        if ($link != ""){
	        if (stripos($link, 'http://') === 0
		            or stripos($link, 'https://') === 0 
		            or stripos($link, 'www' === 0)){		
		        header("Location: " . $link); 
	        } else {
		        header("Location: " . 'http://' . $link); 
	        }
        } else {
            echo '<div> Cant find link with hash: ' . $hash . ' </div>';
        }
    } else {
?>

    <img src="UnderConstruction.png" alt="UnderConstruction"/>

    <h1> Create short link: </h1>
    <form action="index.php" method="post" >
        <fieldset>
            <label for="link"> Link </label>
            <input type="text" id="link" name="link" autofocus="autofocus"
        		placeholder="Enter link" />
            <input type="submit" value="Create" />
        </fieldset>
    </form>

<?php 
    // generate hash
        $site = "http://z-surlsurl.rhcloud.com"; 
    
        $link = $_POST["link"];
        if ($link != ""){
            $id = $model->findLink($link); 
            if ($id == ""){
                $id = $model->insertNewLink($link); 
            }

            $hash = base_convert($id, 10, 36); 
?>

        <div class="shortlink">
            <p class="shortlink"> <?php echo "Your link is: $site/$hash"; ?> </p>
        </div>

<?php 
        }
    } 
?>
    
</body>
</html>

