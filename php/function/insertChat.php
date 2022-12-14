<?php

//insert_chat.php

include('../connectDB.php');

session_start();

$data = array(
	':to_idUser'		=>	$_POST['to_idUser'],
	':from_idUser'		=>	$_SESSION['idUser'],
	':message'		=>	$_POST['message'],
);

$query = "
INSERT INTO chatmessage 
(to_idUser, from_idUser, message, status) 
VALUES (:to_idUser, :from_idUser, :message,)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
	echo fetch_user_chat_history($_SESSION['idUser'], $_POST['to_idUser'], $connect);
}

?>