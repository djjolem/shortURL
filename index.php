<html>
<head>
    <title> Link to ... </title>
    <meta name="description" content="Link shortener"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
 
</head>

<body>
<div class="container">
<?php
    // redirect to another site
    include 'DBConnection.php';
    $model = new DBConnection; 

    $hash = $_GET["hash"];
    if (isset($hash)){
        $link = $model->getLink($hash);

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

    <div>
        <img class="img-rounded" src="underconstruction.png" alt="UnderConstruction"/>
    </div>
  
    <div class="page-header"> 
        <h1> Create short link </h1>  
    </div>

    <form action="index.php" method="post">
    <div class="row">
    <div class="col-lg-6">
    <div class="input-group" id="input">
        <input class="form-control" type="text" id="link" name="link" autofocus="autofocus"
            placeholder="Enter link" />
        <span class="input-group-btn"> 
            <button class="btn btn-primary" type=button" onclick="submit();"> Create </button>
        </span>
    </div>
    </div>
    </div>
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

        <div class="panel panel-primary">
            <div class="panel-heading"> Your short link </div>
            <div class="panel-body">
                <?php echo "$site/$hash"; ?> 
            </div>
        </div>

<?php 
        }
    } 
?>

</div>
</body>
</html>

