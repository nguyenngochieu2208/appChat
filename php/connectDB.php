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
		$query = "SELECT nameUser FROM loginhistory WHERE idUser = '$idUser'";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			return $row['nameUser'];
		}
	}

function fetch_user_last_activity($idUser, $conn)
    {
        $query = "
        SELECT * FROM loginhistory
        WHERE idUser = '$idUser' 
        ORDER BY lastActivity DESC 
        LIMIT 1
        ";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            return $row['lastActivity'];
        }
    }

function fetch_user_chat_history($from_idUser, $to_idUser, $conn)
    {
        $query = "
        SELECT * FROM chatmessage 
        WHERE (from_idUser = '".$from_idUser."' 
            AND to_idUser = '".$to_idUser."') 
            OR (from_idUser = '".$to_idUser."' 
            AND to_idUser = '".$from_idUser."') 
            ORDER BY timestamp DESC
            ";
            $statement = $conn->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '<ul class="list-unstyled">';
            foreach($result as $row)
            {
                $nameUser = '';
                $dynamic_background = '';
                $chatmessage = '';
                if($row["from_idUser"] == $from_idUser)
                {
                    if($row["status"] == '2')
                    {
                        $chatmessage = '<em>tin nhắn đã thu hồi</em>';
                        $nameUser = '<b class="text-success">bạn</b>';
                    }
                    else
                    {
                        $chatmessage = $row['chatmessage'];
                        $nameUser = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['chatmessage_id'].'">x</button>&nbsp;<b class="text-success">Bạn</b>';
                    }
    
    
                    $dynamic_background = 'background-color:#ffe6e6;';
                }
                else
                {
                    if($row["status"] == '2')
                    {
                        $chatmessage = '<em>tin nhắn đã thu hồi</em>';
                    }
                    else
                    {
                        $chatmessage = $row["chatmessage"];
                    }
                    $nameUser = '<b class="text-danger">'.get_user_name($row['from_idUser'], $conn).'</b>';
                    $dynamic_background = 'background-color:#ffffe6;';
                }
                $output .= '
                <li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
                <p>'.$nameUser.' - '.$chatmessage.'
                <div align="right">
                - <small><em>'.$row['timestamp'].'</em></small>
                </div>
                </p>
                </li>
                ';
            }
            $output .= '</ul>';
            $query = "
            UPDATE chatmessage 
            SET status = '0' 
            WHERE from_idUser = '".$to_idUser."' 
            AND to_idUser = '".$from_idUser."' 
            AND status = '1'
            ";
            $statement = $conn->prepare($query);
            $statement->execute();
            return $output;
        }