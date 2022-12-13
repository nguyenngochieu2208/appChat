<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyChat - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/appChat.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <?php require_once "connectDB.php" ;
    session_start();
    $nameUser = $_SESSION['nameUser'];      

    require "function/getUser.php";

    $user = getUser($nameUser, $conn);
    ?>


    <div class="bg-light w-400 shadow">
        <div class="w-100 d-flex justify-content-around align-items-center">

            <div class="d-flex justify-content-center align-items-center ">
                <img style="width: 40px; height: 40px" class="" src="../assets/imgs/avatardf2.png" alt="">
                <?php echo "<p class= \" ms-2 pt-3\">".$nameUser."</p>" ?>
            </div>

            <a class="btn btn-dark text-decoration-none" href="logoutUser.php">Log Out</a>  
        </div>

        <div class="">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="boxchat.php" class="d-flex d-flex align-items-center p-2">
                        <div class="d-flex align-items-center">
                            <img class="size-40" src="../assets/imgs/avatardefault.webp">
                            <h4 class="">Name</h4>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="boxchat.php" class="d-flex d-flex align-items-center p-2">
                        <div class="d-flex align-items-center">
                            <img class="size-40" src="../assets/imgs/avatardefault.webp">
                            <h4 class="">Name</h4>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="boxchat.php" class="d-flex d-flex align-items-center p-2">
                        <div class="d-flex align-items-center">
                            <img class="size-40" src="../assets/imgs/avatardefault.webp">
                            <h4 class="">Name</h4>
                        </div>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>


</body>

</html>

<script>  

	// câu lệnh chạy script mặc định phải có 
	 

	$(document).ready(function(){

		fetch_user();
// cập nhật trạng thái ng dùng sau mỗi 1s
		setInterval(function(){
			update_last_activity();
			fetch_user();
			update_chat_history_data();
			fetch_group_chat_history();
		}, 1000);
// lấy dữ liệu user
		function fetch_user()
		{
			$.ajax({
				url:"fetch_user.php",
				method:"POST",
				success:function(data){
					$('#user_details').html(data);
				}
			})
		}
// cập nhật trạng thái ng dùng
		function update_last_activity()
		{
			$.ajax({
				url:"update_last_activity.php",
				success:function()
				{

				}
			})
		}
// tạo hộp nhắn tin
		function make_chat_dialog_box(to_user_id, to_user_name)
		{
			var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="bạn đang nói chuyện với '+to_user_name+'">';
			modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
			modal_content += fetch_user_chat_history(to_user_id);
			modal_content += '</div>';
			modal_content += '<div class="form-group">';
			modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
			modal_content += '</div><div class="form-group" align="right">';
			modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Gửi</button></div></div>';
			$('#user_model_details').html(modal_content);
		}
// sự kiện nhấn vào bắt đầu trò chuyện 
		$(document).on('click', '.start_chat', function(){
			var to_user_id = $(this).data('touserid');
			var to_user_name = $(this).data('tousername');
			make_chat_dialog_box(to_user_id, to_user_name);
			$("#user_dialog_"+to_user_id).dialog({
				autoOpen:false,
				width:400
			});
			$('#user_dialog_'+to_user_id).dialog('open');
			$('#chat_message_'+to_user_id).emojioneArea({
				pickerPosition:"top",
				toneStyle: "bullet"
			});
		});
//thực hiện hành động gửi tin nhắn
		$(document).on('click', '.send_chat', function(){
			var to_user_id = $(this).attr('id');
			var chat_message = $.trim($('#chat_message_'+to_user_id).val());
			if(chat_message != '')
			{
				$.ajax({
					url:"insert_chat.php",
					method:"POST",
					// vì là biến giá trị thì k để trong dấu kép và thay dấu = thành dấu :
					data:{to_user_id:to_user_id, chat_message:chat_message},
				// thực hiên gửi thành công
				// thêm emoji
					success:function(data)
					{
					//$('#chat_message_'+to_user_id).val('');
						var element = $('#chat_message_'+to_user_id).emojioneArea();
						element[0].emojioneArea.setText('');
						$('#chat_history_'+to_user_id).html(data);
					}
				})
			}
			else
			{
				alert('cần nhập msg');
			}
		});
// real time 
		function fetch_user_chat_history(to_user_id)
		{
			$.ajax({
				url:"fetch_user_chat_history.php",
				method:"POST",
				data:{to_user_id:to_user_id},
				success:function(data){
					$('#chat_history_'+to_user_id).html(data);
				}
			})
		}
// cập nhật lịch sử trò chuyện 
		function update_chat_history_data()
		{
			$('.chat_history').each(function(){
				// tìm dữ liệu và cập nhật vào id user
				var to_user_id = $(this).data('touserid');
				fetch_user_chat_history(to_user_id);
			});
		}

		$(document).on('click', '.ui-button-icon', function(){
			$('.user_dialog').dialog('destroy').remove();
			$('#is_active_group_chat_window').val('no');
		});
// xl khi đối phương đang gõ
		$(document).on('focus', '.chat_message', function(){
			var is_type = 'yes';
			$.ajax({
				url:"update_is_type_status.php",
				method:"POST",
				data:{is_type:is_type},
				success:function()
				{

				}
			})
		});

// khi đối phương k gõ nữa thì thực thi lệnh này 
		$(document).on('blur', '.chat_message', function(){
			var is_type = 'no';
			$.ajax({
				url:"update_is_type_status.php",
				method:"POST",
				data:{is_type:is_type},
				success:function()
				{

				}
			})
		});
// thực hiện chat nhóm
		$('#group_chat_dialog').dialog({
			autoOpen:false,
			width:400
		});
// thực hiện khi ấn vào group chát
		$('#group_chat').click(function(){
			$('#group_chat_dialog').dialog('open');
			$('#is_active_group_chat_window').val('yes');
			fetch_group_chat_history();
		});
// gửi tin nhắn
		$('#send_group_chat').click(function(){
			var chat_message = $.trim($('#group_chat_message').html());
			var action = 'insert_data';
			if(chat_message != '')
			{
				$.ajax({
					url:"group_chat.php",
					method:"POST",
					data:{chat_message:chat_message, action:action},
					success:function(data){
						$('#group_chat_message').html('');
						$('#group_chat_history').html(data);
					}
				})
			}
			else
			{
				alert('k đc để chống');
			}

		});

		function fetch_group_chat_history()
		{
			var group_chat_dialog_active = $('#is_active_group_chat_window').val();
			var action = "fetch_data";
			if(group_chat_dialog_active == 'yes')
			{
				$.ajax({
					url:"group_chat.php",
					method:"POST",
					data:{action:action},
					success:function(data)
					{
						$('#group_chat_history').html(data);
					}
				})
			}
		}
		// giửi ảnh
		$('#uploadFile').on('change', function(){
			$('#uploadImage').ajaxSubmit({
				target: "#group_chat_message",
				resetForm: true
			});
		});

		// xóa tin nhắn 
		$(document).on('click', '.remove_chat', function(){
			var chat_message_id = $(this).attr('id');
			if(confirm("bạn có chắc chắn muốn thu hồi tin nhắn?"))
			{
				$.ajax({
					url:"remove_chat.php",
					method:"POST",
					data:{chat_message_id:chat_message_id},
					success:function(data)
					{
						update_chat_history_data();
					}
				})
			}
		});




	});  
</script>