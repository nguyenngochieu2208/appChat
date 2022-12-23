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
    

// function get_user_name($idUser, $conn)
// 	{	
// 		$query = "SELECT nameUser FROM inforuser WHERE idUser = '$idUser'";
// 		$statement = $conn->prepare($query);
// 		$statement->execute();
// 		$result = $statement->fetchAll();											
// 		foreach($result as $rows)
// 		{
// 			return $rows['nameUser'];
// 		}
// 	}

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
				if( $rows['dltMessage'] == 1 )
				{
					$message = '<p align="right" style= "font-size: 20px; margin: 0 5px;"> Tin nhắn này đã thu hồi! </p>';

					$nameUser = '<b class="text-success">Bạn</b>';
					
				}
				else{
					$message = $rows['message'];

					$nameUser = '<div class="d-flex justify-content-between m-0 p-0">
					<button type= "button" style = " color: red; font-weight: bold; " class = "btn remove_Mess" id = "'.$rows['idMessage'].'">X</button>&nbsp;
					<b class="text-success">Bạn</b>
					</div>';
					
				}
				
				
				$background_mess = 'background-color:#ffe6e6;';
		
				$mess = '
						<p >'.$nameUser.'</p>
					
					 
					<p align="right" style= "font-size: 20px; margin: 0 5px; "> </br> '.$message.'</p>

					<div>
						<small><em>'.$rows['timeMessage'].'</em></small>
					</div>
				
				';
			
			}
			else
			{
				if( $rows['dltMessage'] == 1 )
				{
					$message = '<p style= "font-size: 20px; margin: 0 5px;"> Tin nhắn này đã thu hồi! </p>';
				}
				else{
					$message = $rows['message'];
				}

				$nameUser = '<b class="text-danger">'.get_user_name($rows['from_idUser'], $conn).'</b>';
				$background_mess= 'background-color: #dcdcdc;';

				$mess = '<div class="d-flex justify-content-between m-0 p-0" style= "">
					<p style="text-align-center">'.$nameUser.' </p>
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

function fetch_group_chat_history($conn)
	{
		$query = "
		SELECT * FROM chatmessage 
		WHERE to_idUser = '0'  
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
			if($rows["from_idUser"] == $_SESSION['idUser'])
			{
				if( $rows['dltMessage'] == 1 )
				{
					$message = '<p align="right" style= "font-size: 20px; margin: 0 5px;"> Tin nhắn này đã thu hồi! </p>';

					$nameUser = '<b class="text-success">Bạn</b>';



					
				}
				else{
					$message = $rows['message'];

					$nameUser = '<div class="d-flex justify-content-between m-0 p-0">
					<button type= "button" style = " color: red; font-weight: bold; " class = "btn remove_Mess" id = "'.$rows['idMessage'].'">X</button>&nbsp;
					<b class="text-success">Bạn</b>
					</div>';
					
				}
				
				
				$background_mess = 'background-color:#ffe6e6;';
		
				$mess = '
						<p >'.$nameUser.'</p>
					
					 
					<p align="right" style= "font-size: 20px; margin: 0 5px; "> </br> '.$message.'</p>

					<div>
						<small><em>'.$rows['timeMessage'].'</em></small>
					</div>
				
				';
			
			}
			else
			{
				if( $rows['dltMessage'] == 1 )
				{
					$message = '<p style= "font-size: 20px; margin: 0 5px;"> Tin nhắn này đã thu hồi! </p>';
				}
				else{
					$message = $rows['message'];
				}

				$nameUser = '<b class="text-danger">'.get_user_name($rows['from_idUser'], $conn).'</b>';
				$background_mess= 'background-color: #dcdcdc;';

				$mess = '<div class="d-flex justify-content-between m-0 p-0" style= "">
					<p style="text-align-center">'.$nameUser.' </p>
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