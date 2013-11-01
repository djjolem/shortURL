<html>
<head>
    <title> Link to ... </title>
    <meta name="description" content="Link shortener"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/my_style.css" />
</head>

<body>
<div class="container" id="container">
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

    <div id="img_construction">
        <img class="img-rounded" src="underconstruction.png" alt="UnderConstruction"/>
    </div>
  
    <div id="head_text" class="page-header"> 
        <h1> Create short link </h1>  
    </div>

    <form action="index.php" method="post">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
        <div class="input-group" id="input">
            <input class="form-control" type="text" id="link" name="link" autofocus="autofocus"
                placeholder="Enter link" />
            <span class="input-group-btn"> 
                <button class="btn btn-primary" type="button" onclick="submit();"> Create </button>
            </span>
        </div>
        </div>
        <div class="col-lg-3"></div>
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

	<!-- login form -->
	<form class="form-horizontal" role="form">
		<div class="form-group">
    		<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    		<div class="col-sm-10">
      			<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    		</div>
  		</div>
  		<div class="form-group">
    		<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    		<div class="col-sm-10">
      			<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    		</div>
  		</div>
  		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<div class="checkbox">
        			<label><input type="checkbox"> Remember me </label>
      			</div>
    		</div>
  		</div>
  		<div class="form-group">
    		<div class="col-sm-offset-2 col-sm-10">
      			<button type="submit" class="btn btn-default">Sign in</button>
    		</div>
  		</div>
	</form>

	<!-- add create account -->
	<div> Create account </div>

   
</div><!--id=container-->
</body>
</html>
