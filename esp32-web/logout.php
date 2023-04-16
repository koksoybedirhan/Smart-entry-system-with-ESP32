<?php
    include "libs/db.php";
    include "libs/session.php";
    include "libs/funcitons.php";

    session_start();

    $_SESSION = array();

    session_destroy();

    header('Location: index.php');

    exit;
?>