<?php

function getUser($nameUser , $conn)
{
    $sql = "SELECT * FROM inforuser WHERE nameUser= ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$nameUser]);  
    
    if($stmt ->rowCount() === 1){
        $user = $stmt->fetch();
        return $user;
    }

    else{
        $user =[];
        return $user;
    }
}

?>