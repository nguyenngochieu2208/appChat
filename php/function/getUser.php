<?php

//fetch_user.php

include('../connectDB.php');

session_start();

$sql = "
SELECT * FROM inforuser
WHERE idUser != '".$_SESSION['idUser']."' 
";

$statement = $conn->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<div class = "w-100 mt-4 " >
';

foreach($result as $row)
{	
	if($row['statusUser'] == 0)
	{
		$status = '<span style="height:30px; width:60px;"  class="w-100 label label-danger">Offline</span>';
	}

	elseif($row['statusUser'] == 1){			
		$status = '<span style="height:30px; width:60px; " class="w-100 label label-success">Active Now</span>';	

		
	}
	$output .= '
	<div style="height:40px " class = "d-flex justify-content-around align-items-center mb-2">
			<p style = "width:200px ;font-size: 25px; font-weight: 200px" class= "m-0 p-0"> '.$row['nameUser'].'</p>
			<div style="width:60px; height:30px; ">'.$status.'</div>
			<div><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['idUser'].'" data-tousername="'.$row['nameUser'].'">Trò Chuyện</button></div>
	</div>';
}

$output .= '</div>';

echo $output;

?>