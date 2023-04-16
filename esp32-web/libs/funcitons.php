<?php 
    function getData()
    {
        include "db.php";
    
        $query = "SELECT * from veri ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($baglanti, $query);
        mysqli_close($baglanti);
        return $result;
    }

    function getAllDatas()
    {
        include "db.php";
    
        $query = "SELECT * from veri";
        $result = mysqli_query($baglanti, $query);
        mysqli_close($baglanti);
        return $result;
    }
?>
