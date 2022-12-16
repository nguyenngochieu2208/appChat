 <?php require_once "connectDB.php" ;
    session_start();
    $nameUser = $_SESSION['nameUser'];  
 ?>
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
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
     <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
 </head>

 <body class="d-flex justify-content-center align-items-center vh-100">



     <div class="container bg-light w-400 shadow">
         <div class="w-100 d-flex justify-content-between align-items-center" style="border-bottom: 2px solid black;">

             <div class="d-flex justify-content-center align-items-center " >    
                 <img style="width: 40px; height: 40px" class="" src="../assets/imgs/avatardf2.png" alt="">
                 <?php echo "<p style = \" font-size: 20px \" class= \" ms-4 pt-3\">".$nameUser."</p>" ?>
             </div>

             
             <a class="btn btn-dark text-decoration-none" href="logoutUser.php">Log Out</a>
         </div>

         <div class="rowUser">
             <div class="w-100" id="user_details"></div>
             <div id="user_model_details"></div>
         </div>
         <br />
         <br />
     </div>


 </body>

 </html>

 <script>

$(document).ready(function() {

    getUser();
    setInterval(function() {
        getUser();
        update_chat_history_data();
    }, 1000);

    // lấy dữ liệu user
    function getUser() {
        $.ajax({
            url: "function/getUser.php",
            method: "POST",
            success: function(data) {
                $('#user_details').html(data);
            }
        })
    }


    // cập nhật trạng thái ng dùng
    // function update_last_activity() {
    //     $.ajax({
    //         url: "function/update_last_activity.php",
    //         success: function() {}
    //     })
    // }


    // tạo hộp nhắn tin
    function make_chat_dialog_box(to_idUser, to_nameUser) {
        var modal_content = '<div style ="font-weight: 150px; color: #0000FF" id="user_dialog_' + to_idUser +
            '" class="user_dialog" title="' + to_nameUser + '">';
        modal_content +=
            '<div style="height:500px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
            to_idUser + '" id="chat_history_' + to_idUser + '">';
        modal_content += print_chat_history(to_idUser);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="message" id="message_' + to_idUser +
            '" class="form-control message"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        // modal_content += '<div class="image_upload">'
        // modal_content +=
        //     '<form id="uploadImage" method="post" action="function/uploadIMG.php" enctype="multipart/form-data">'
        // modal_content += '<label for="uploadFile"><img style="height: 14px; width: 14px;" src="../assets/imgs/upload.png" /></label>'
        // modal_content += '<input type="file" name="uploadFile" id="uploadFile"/>'
        // modal_content += '</form>'
        // modal_content += '</div>'
        modal_content += '<button type="button" name="send_chat" idUser="' + to_idUser +
            '" class="btn btn-info send_chat">Gửi</button></div></div>';
        $('#user_model_details').html(modal_content);
    }


    // sự kiện nhấn vào bắt đầu trò chuyện 
    $(document).on('click', '.start_chat', function() {
        var to_idUser = $(this).data('touserid');
        var to_nameUser = $(this).data('tousername');
        make_chat_dialog_box(to_idUser, to_nameUser);
        $("#user_dialog_" + to_idUser).dialog({
            autoOpen: false,
            width: 400
        });
        $('#user_dialog_' + to_idUser).dialog('open');
        $('#message_' + to_idUser).emojioneArea({
            pickerPosition: "top",
            toneStyle: "bullet"
        });
        print_chat_history(to_idUser);
    });



    //bat su kien gui tin nhan
    $(document).on('click', '.send_chat', function() {
        var to_idUser = $(this).attr('idUser');
        var message = $.trim($('#message_' + to_idUser).val());
        $.ajax({
            url: "function/insertChat.php",
            method: "POST",
            data: {
                to_idUser: to_idUser,
                message: message,
            },
            success: function(data) {
                var element = $('#message_' + to_idUser).emojioneArea();
                element[0].emojioneArea.setText('');
                $('#chat_history_' + to_idUser).html(data);
            }
        })
    });

    //print_message_realtime
    function print_chat_history(to_idUser) {
        $.ajax({
            url: "function/getUser_chat_history.php",
            method: "POST",
            data: {
                to_idUser: to_idUser
            },
            success: function(data) {
                $('#chat_history_' + to_idUser).html(data);
            }
        })
    }

    // function update_chat_history_data()
    // 	{
    // 		$('.chat_history').each(function(){
    // 			var to_idUser = $(this).data('touserid');
    //             console.log(to_idUser);
    // 			print_chat_history(to_idUser);

    // 		});
    // 	}


    function update_chat_history_data() {
        $('.chat_history').each(function() {
            var to_idUser = $(this).data('touserid');
            print_chat_history(to_idUser);
            console.log(to_idUser);
        });
    }

});
 </script>