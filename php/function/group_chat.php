<?php
	 include('../connectDB.php');

session_start();

if($_POST["action"] == "insert_data")
{
 $data = array(
  ':from_idUser'  => $_SESSION["idUser"],
  ':message'  => $_POST['message'],
  ':dltMessage'   => '0'
 );

 $query = "
 INSERT INTO chatmessage 
 (from_idUser, message, dltMessage) 
 VALUES (:from_idUser, :message, :dltMessage)
 ";

 $statement = $conn->prepare($query);

 if($statement->execute($data))
 {
  echo fetch_group_chat_history($conn);
 }

}

if($_POST["action"] == "fetch_data")
{
 echo fetch_group_chat_history($conn);
}

?>