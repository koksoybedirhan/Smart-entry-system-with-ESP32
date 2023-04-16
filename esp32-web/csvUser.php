<?php 
    include "libs/db.php";
    include "libs/session.php";
    include "libs/funcitons.php";
    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=logUser.csv");

    $result = getAllUsers();  while($data = mysqli_fetch_assoc($result)):
        echo $data["name"]." ";
        echo $data["rfid"]." ";
        echo $data["status"]."\n";
    endwhile;
?>
