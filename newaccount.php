<!DOCTYPE html>
<html>
<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/my_style.css" />

</head>
<?php

?> 
<body>
    <div class="container" id="container">
    <div id="head_text" class="page-header">
	<h1> Create new account ... </h1>
    </div>

<?php
    if (isset($_GET["error"])){
?>
    <div class="text">
	<h2> <?php echo($_GET["error"]); ?>
    </div>
<?php
    }
?>

	<!-- creat new accoutn -->
        <form class="form-horizontal" role="form" action="creat.php" method="post">
                <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail"
                    name="inputEmail" placeholder="Email">
                        </div>
                </div>

                <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password 1</label>
                        <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword1"
                    name="inputPassword2" placeholder="Password">
                        </div>
                </div>

		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">Password 2</label>
                        <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword2"
				    name="inputPassword2" placeholder="Password">
                        </div>
                </div>


                <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"> Create account </button>
                        </div>
                </div>
	</form>
    </div>
</body>

</html>

