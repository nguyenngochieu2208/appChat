<?php

try {
    $host = "localhost";
    $dbname = "appchat";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Lỗi : " . $e->getMessage());
}
    

function get_user_name($idUser, $conn)
	{
		$query = "SELECT nameUser FROM inforuser WHERE idUser = '$idUser'";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $rows)
		{
			return $rows['nameUser'];
		}
	}

function print_chat_history($from_idUser, $to_idUser, $conn){
	$query = "
	SELECT * FROM chatmessage 
	WHERE (from_idUser = '".$from_idUser."' 
		AND to_idUser = '".$to_idUser."') 
		OR (from_idUser = '".$to_idUser."' 
		AND to_idUser = '".$from_idUser."') 
		ORDER BY timeMessage DESC
		";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		
		$output = '<ul class="list-unstyled">';
		foreach( $result as $rows){
			$nameUser = '';
			$background_mess = '';
			$message = '';
			$mess = null;
			if($rows["from_idUser"] == $from_idUser)
			{
				
				$message = $rows['message'];
				$nameUser = '<b class="text-success">Bạn</b>';
				$background_mess = 'background-color:#ffe6e6;';
		
				$mess = '<div class="d-flex justify-content-between m-0 p-0" style= "">
						<p style= "margin:0; padding: 0;" align= "right">
							<span style="cursor: pointer; font-size: 25px; magin: 0; padding: 0;">&times;</span>
						</p>
						<p >'.$nameUser.'</p>
					</div>
					 
					<p align="right" style= "font-size: 20px; margin: 0 5px; "> </br> '.$message.'</p>

					<div>
						<small><em>'.$rows['timeMessage'].'</em></small>
					</div>
				
				';
			
			}
			else
			{
				$message = $rows["message"];
				$nameUser = '<b class="text-danger">'.get_user_name($rows['from_idUser'], $conn).'</b>';
				$background_mess= 'background-color: #dcdcdc;';

				$mess = '<div class="d-flex justify-content-between m-0 p-0" style= "">
					<p style="text-align-center">'.$nameUser.' </p>
					<p style= "margin:0; padding: 0;" align= "right">
						<span style="cursor: pointer; font-size: 25px; magin: 0; padding: 0;">&times;</span>
					</p>
				</div>

				<p style= "font-size: 20px; margin: 0 5px;"></br> '.$message.'</p>

				<div align="right">
					<small><em>'.$rows['timeMessage'].'</em></small>
				</div>
				';
			}
			$output .= '
			<li type= "button" style="padding:4px ; border:1px solid #ccc; border-radius: 10px; margin-bottom:10px;  '.$background_mess.'">
			'.$mess.'
			</li>
			';
		}
		$output .= '</ul>';
		return $output;
}

?>