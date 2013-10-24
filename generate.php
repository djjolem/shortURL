<html>
<head>
</head>

<body>
    <h5>Creating hash for link:</h5><br />
    <?php
        include 'DBConnection.php';
        $model = new DBConnection;

        $site = "djm.rs";

        $link = $_POST["link"];
        $id = $model->findLink($link);
        if ($id == ""){
            $id = $model->insertNewLink($link);
        }
        $hash = base_convert($id, 10, 36);

        echo "Your link is: " . $site .'/'. $hash;
    ?>

    <br /><br />
    <a href="./index.php"> Generate another hash </a>

</body>
</html>

