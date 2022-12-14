<?php

// cập nhật trạng thái hoạt động cuối 

include('../connectDB.php');

session_start();

$query = "
UPDATE loginhistory 
SET lastActivity = now() 
WHERE idLogin = '".$_SESSION["idLogin"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>

