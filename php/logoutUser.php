<?php
    require_once ("connectDB.php");
    session_start();

    session_unset();
    session_destroy();

    $sql = "UPDATE loginhistory SET statusUser = '0' ";
    $conn->exec($sql);

    header("location: loginUser.php");
    exit;   

?>