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

    function getUser()
    {
        include "db.php";
    
        $query = "SELECT * from user ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($baglanti, $query);
        mysqli_close($baglanti);
        return $result;
    }

    function getAllUsers()
    {
        include "db.php";
    
        $query = "SELECT * from user";
        $result = mysqli_query($baglanti, $query);
        mysqli_close($baglanti);
        return $result;
    }

    function isLoggedin() {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            return true;
        } else {
            return false;
        }
    }
?>
