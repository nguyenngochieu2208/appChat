<?php

//insert_chat.php

include('../connectDB.php');

session_start();

$data = array(
	':to_idUser'		=>	$_POST['to_idUser'],
	':from_idUser'		=>	$_SESSION["idUser"],
	':message'		=>	$_POST['message'],
	':dltMessage'	=> '0',
);


$query = "
INSERT INTO chatmessage 
(to_idUser, from_idUser, message, dltMessage) 
VALUES (:to_idUser, :from_idUser, :message, :dltMessage)
";

$statement = $conn->prepare($query);

if($statement->execute($data))
{
	echo print_chat_history($_SESSION["idUser"], $_POST['to_idUser'], $conn);
}

?>
