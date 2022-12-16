<?php
    require_once ("connectDB.php");
    session_start();
    $idUser = $_SESSION['idUser'];
    $sql = "UPDATE inforuser SET statusUser = '0' WHERE idUser = $idUser ";
    $conn->exec($sql);


    session_unset();
    session_destroy();


    header("location: loginUser.php");
    exit;   

?>