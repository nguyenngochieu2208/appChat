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
    ?>


    <div class="container bg-light w-400 shadow">
        <div class="w-100 d-flex justify-content-around align-items-center">

            <div class="d-flex justify-content-center align-items-center ">
                <img style="width: 40px; height: 40px" class="" src="../assets/imgs/avatardf2.png" alt="">
                <?php echo "<p class= \" ms-2 pt-3\">".$nameUser."</p>" ?>
            </div>

            <a class="btn btn-dark text-decoration-none" href="logoutUser.php">Log Out</a>
        </div>

        <div class="table-responsive">

            <div id="user_details"></div>
            <div id="user_model_details"></div>
        </div>
        <br />
        <br />
    </div>


</body>

</html>

<script>
// câu lệnh chạy script mặc định phải có 


$(document).ready(function() {

    fetch_user();
    // cập nhật trạng thái ng dùng sau mỗi 1s
    setInterval(function() {
        update_last_activity();
        fetch_user();
        update_chat_history_data();
    }, 1000);
    // lấy dữ liệu user
    function fetch_user() {
        $.ajax({
            url: "function/getUser.php",
            method: "POST",
            success: function(data) {
                $('#user_details').html(data);
            }
        })
    }
    // cập nhật trạng thái ng dùng
    function update_last_activity() {
        $.ajax({
            url: "update_last_activity.php",
            success: function() {

            }
        })
    }
    // tạo hộp nhắn tin
    function make_chat_dialog_box(to_idUser, to_nameUser) {
        var modal_content = '<div id="user_dialog_' + to_idUser +
            '" class="user_dialog" title="bạn đang nói chuyện với ' + to_nameUser + '">';
        modal_content +=
            '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
            to_user_id + '" id="chat_history_' + to_idUser + '">';
        modal_content += fetch_user_chat_history(to_idUser);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="chat_message_' + to_idUser + '" id="chat_message_' + to_idUser +
            '" class="form-control chat_message"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        modal_content += '<button type="button" name="send_chat" id="' + to_idUser +
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
        $('#chat_message_' + to_idUser).emojioneArea({
            pickerPosition: "top",
            toneStyle: "bullet"
        });
    });
    //thực hiện hành động gửi tin nhắn
    $(document).on('click', '.send_chat', function() {
        var to_idUser = $(this).attr('id');
        var chat_message = $.trim($('#chat_message_' + to_idUser).val());
        if (chat_message != '') {
            $.ajax({
                url: "insert_chat.php",
                method: "POST",
                // vì là biến giá trị thì k để trong dấu kép và thay dấu = thành dấu :
                data: {
                    to_idUser: to_idUser,
                    chat_message: chat_message
                },
                // thực hiên gửi thành công
                // thêm emoji
                success: function(data) {
                    //$('#chat_message_'+to_idUser).val('');
                    var element = $('#chat_message_' + to_idUser).emojioneArea();
                    element[0].emojioneArea.setText('');
                    $('#chat_history_' + to_idUser).html(data);
                }
            })
        } else {
            alert('cần nhập msg');
        }
    });
    // real time 
    function fetch_user_chat_history(to_idUser) {
        $.ajax({
            url: "function/getUser_chat_history",
            method: "POST",
            data: {
                to_idUser: to_idUser
            },
            success: function(data) {
                $('#chat_history_' + to_idUser).html(data);
            }
        })
    }
    // cập nhật lịch sử trò chuyện 
    function update_chat_history_data() {
        $('.chat_history').each(function() {
            // tìm dữ liệu và cập nhật vào id user
            var to_idUser = $(this).data('touserid');
            fetch_user_chat_history(to_idUser);
        });
    }

});
</script>