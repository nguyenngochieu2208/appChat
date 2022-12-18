<?php 

    require_once "../connectDB.php";

    if(isset($_POST["idMessage"])){
        $sql = " UPDATE chatmessage SET dltMessage = '1' WHERE idMessage = '". $_POST["idMessage"]."' ";
        $statement = $conn->prepare($sql);

        $statement->execute();
    }

?>