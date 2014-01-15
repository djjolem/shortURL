<!DOCTYPE html>
<html>
<head>
    <?php
        session_start(); 
    ?> 
    
    <title> Link to ... </title>
    <meta name="description" content="Link shortener"/>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/my_style.css" />
    
<?php
    // redirect to another site
    include 'DBConnection.php';
    $model = new DBConnection; 

    if (isset($_GET["hash"])){
        $hash = $_GET["hash"];
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
</head>


<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation"> 
<div class="container">
<?php /*
    echo ">{$_SERVER['SERVER_SOFTWARE']} <br>"; 
    echo ">{$_SERVER['SERVER_NAME']} <br>"; 
    echo ">{$_SERVER['SERVER_ADDR']}:{$_SERVER['SERVER_PORT']} <br>";
    echo ">{$_SERVER['REMOTE_ADDR']} <br>";
    echo ">{$_SERVER['SERVER_PROTOCOL']} <br>"; 
    echo ">{$_SERVER['REQUEST_METHOD']} <br>"; 
    echo ">{$_SERVER['QUERY_STRING']} <br>";
    echo ">{$_SERVER['REQUEST_URI']} <br>";
    echo ">{$_SERVER['REQUEST_TIME']} <br>"; 
*/
?>
<!--
    <div class="navbar-header">
        <a href="" class="navbar-brand"> Short URL </a>
    </div>
    
    <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">

        <!-- create account 
        <li>
        <form class="form-horizontal" role="form" action="newaccount.php" method="post">
        <div class="navbar-header">
            <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default"> Sign up </button>
            </div>
            </div>
        </div>
        </form>
        </li>

        <!-- vertical divider 
        <li>
        <div class=""> &nbsp; &nbsp; </div>
        </li>

        <!-- singn in accoutn 
        <li class="dropdown">
            <button type="submit" class="dropdown-toggle btn btn-default" data-toggle="dropdown" > 
                    Sign in <b class="caret"></b> 
            </button>
            
            <div class="dropdown-menu">
            <div class="btn-group">
            <form class="form-horizontal" role="form" action="signin.php" method="post">
                <div class="form-group">
                    <div class="col-sm-10">
                        <label for="inputEmail" class="col-sm-2 control-label"></label>
                        <input type="email" class="form-control" id="inputEmail" 
                            name="inputEmail" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <label for="inputPassword" class="col-sm-2 control-label"></label>
                        <input type="password" class="form-control" id="inputPassword" 
                            name="inputPassword" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <input id="remember_me" type="checkbox" name="remember_me" value="1" />
                        <label class="string optional" for="remember_me"> Remember me</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <label for="" class="col-sm-2 control-label"></label>
                        <button type="submit" class="btn btn-default"> Sign in </button>
                    </div>
                </div>          
            </form>
            </div>
            </div>
        </li>

        <li>
            <div class=""> &nbsp; &nbsp; </div>
        </li>
      </ul>
    </div><!--.nav-collapse-->

</div><!--.container-->
</div>


<div class="container" id="container">
<div class="jumbotron">


    <div id="img_construction">
        <img class="img-rounded img-responsive" src="underconstruction.png" alt="UnderConstruction"/>
    </div>
  
    <div id="head_text" class="page-header"> 
        <h1> Create short link </h1>  
    </div>

    <form class="form-horizontal" role="form" action="index.php" method="post">
    <div class="form-group">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
        <div class="input-group" id="input">
            <input class="form-control" type="text" id="link" name="link" autofocus="autofocus"
                placeholder="Enter link" />
            <span class="input-group-btn"> 
                <button class="btn btn-primary" type="button" onclick="submit();"> Create </button>
            </span>
        </div>
        <div></div>
        </div>
        <div class="col-lg-3"></div>
    </div>
    </form>

<?php 
    // generate hash
        $site = "http://z-surlsurl.rhcloud.com"; 
   
        if (isset($_POST["link"])){ 
            $link = $_POST["link"];
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

    $login = FALSE; 
    if (isset($_SESSION["signed"])){
        $login = (bool)$_SESSION["signed"]; 
    }

    if (!$login){
?>
    
	<!-- login form 
	<form class="form-horizontal" role="form" action="signin.php" method="post">
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" id="inputEmail" 
                    name="inputEmail" placeholder="Email">
			</div>
  		</div>

  		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword" 
                    name="inputPassword" placeholder="Password">
			</div>
  		</div>

  		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default"> Sign in </button>
			</div>
  		</div>
	</form>


	<!-- add create account 
	<form class="form-horizontal" role="form" action="newaccount.php" method="post">
	<div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default"> Create an account </button>
		</div>
	</div>
	</form>
    -->

<?php
    } else { 
?>
	<form class="form-horizontal" role="form" action="signout.php" method="post">
	    <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		    <button type="submit" class="btn btn-default"> Sign out </button>
		</div>
	    </div>
	</form>
<?php
    }
?>
</div>
</div><!--id=container-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/bootstrap.js"></script>


<script type="text/javascript">
    $(function() {
        // Setup drop down menu
        $('.dropdown-toggle').dropdown();
 
        // Fix input element click problem
        $('.dropdown input, .dropdown label').click(function(e) {
            e.stopPropagation();
        });
    });
</script>

</body>
</html>

