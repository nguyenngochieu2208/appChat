<?php

// hiển thị tin nhăn vào ra hộp thoại

include('../connectDB.php');

session_start();


// nạp lịch sử tin  nhắn qua id
echo print_chat_history($_SESSION["idUser"], $_POST['to_idUser'], $conn);

?>