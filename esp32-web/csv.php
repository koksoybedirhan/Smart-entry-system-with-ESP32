<?php 
    include "libs/db.php";
    include "libs/session.php";
    include "libs/funcitons.php";
    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=log.csv");

    $result = getAllDatas();  while($data = mysqli_fetch_assoc($result)):
        echo $data["temp"]." ";
        echo $data["hum"]." ";
        echo $data["time"]."\n";
    endwhile;
?>

