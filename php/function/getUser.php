<?php

//fetch_user.php

include('../connectDB.php');

session_start();

$sql = "
SELECT * FROM loginhistory 
WHERE idUser != '".$_SESSION['idUser']."' 
";

$statement = $conn->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="40%">Username</td>
		<th width="20%">Status</td>
		<th width="10%">Action</td>
	</tr>
';

foreach($result as $row)
	// thời gian nhận tin nhắn
	
{
	$status = '';
	$current_timestamp = strtotime(date("h:i:s d-m-Y") );
	$current_timestamp = date("h:i:s d-m-Y", $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['idUser'], $conn);
	if($user_last_activity > $current_timestamp)    
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	// cứ 5s cập nhật trạng thái mới xem có tin nhắn chờ nào k và hiển thị đối phương đang nhập tin nhắn
	$output .= '
	<tr>

		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">bắt đầu chat</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>