<html>
<head>
    <title> Link to ... </title>
    <meta name="description" content="Link shortener"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<?php
    include 'DBConnection.php';

    $hash = $_GET["hash"];
    if (isset($hash)){
        $model = new DBConnection;
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
    <form action="generate.php" method="post" >
        <fieldset>
            <label for="link"> Link </label>
            <input type="text" id="link" name="link" autofocus="autofocus" />
            <input type="submit" value="Create" />
        </fieldset>
    </form>

<?php } ?>
    
</body>
</html>

