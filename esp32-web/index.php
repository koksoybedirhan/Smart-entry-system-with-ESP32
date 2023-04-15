<?php
    include "libs/db.php";

    $temperature = $humidity = "";

    if(!empty($_GET['temp']) && !empty($_GET['hum']))
    {
        $temperature = $_GET['temp'];
        $humidity = $_GET['hum']; 
    }
             
    $query = "INSERT INTO veri (temp, hum) VALUES ('$temperature', '$humidity')";
    $result = mysqli_query($baglanti, $query);
    echo $temperature." / ".$humidity;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>