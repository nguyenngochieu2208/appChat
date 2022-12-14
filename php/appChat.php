 <?php require_once "connectDB.php" ;
 
    session_start();
    $nameUser = $_SESSION['nameUser'];  


    $sql = "
    SELECT * FROM inforuser
    WHERE idUser != '".$_SESSION['idUser']."' 
    "; 
    $statement = $conn->prepare($sql);

    $statement->execute();

    $result = $statement->fetchAll();   



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
     <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
     <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>





 </head>

 <body class="d-flex justify-content-center align-items-center vh-100">



     <div class="container bg-light w-400 shadow">
         <div class="w-100 d-flex justify-content-between align-items-center" style="border-bottom: 2px solid black;">

             <div class="d-flex justify-content-center align-items-center ">
                 <img style="width: 40px; height: 40px" class="" src="../assets/imgs/avatardf2.png" alt="">
                 <?php echo "<p style = \" font-size: 20px \" class= \" ms-4 pt-3\">".$nameUser."</p>" ?>
             </div>

             <div>
                 <input type="hidden" id="is_active_group_chat_window" value="no" />
                 <button type="button" name="group_chat" id="group_chat" class="btn btn-success btn-xs">Nh??m
                     Chat</button>
             </div>


             <a class="btn btn-dark text-decoration-none" href="logoutUser.php">Log Out</a>
         </div>

         <div class="rowUser">
             <div class="w-100" id="user_details">
<<<<<<< HEAD
=======

>>>>>>> 8914edb560e5d32b5a0f25d4410964c117f817c0
             </div>
         </div>

     </div>
     <br />
     <br />
     </div>

<<<<<<< HEAD
    <div id="user_model_details"></div> 





    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        Pusher.logToConsole = true;

       
        var pusher = new Pusher('504e1e3617aac7eed5cc', {
        cluster: 'ap1'
        });


        var channel = pusher.subscribe('Chat');
        channel.bind('getGmail', function(data) {
            alert(JSON.stringify(data));

            var gmailUser = data['message'];
            var tr;
            tr = '<p>GmailUser:';
            tr += gmailUser;
            tr += '</p>';

            $('#user_details').append(tr);


        // $.ajax({
        //             url: "function/getUser.php",    
        //             method: "POST",
        //             data: {
        //                 nameUser: nameUser,
        //                 statusUser : statusUser
        //             },
        //             success: function(result) {
        //                 $('#user_details').html(result);
        //             }
        //         })
            
    });

    </script>
=======
     <div id="user_model_details"></div>
>>>>>>> 8914edb560e5d32b5a0f25d4410964c117f817c0

 </body>

 </html>

 <div id="group_chat_dialog" title="Nh??m Chat Chung">
     <div id="group_chat_history"
         style="height:500px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">
     </div>
     <div class="form-group">
         <div class="chat_message_area">
             <div data-nameUser="<?php echo $nameUser ?>" id="group_chat_message" contenteditable class="form-control">

             </div>
             <div class="image_upload">
                 <form id="uploadImage" method="post" action="uploadIMG.php" enctype="multipart/form-data">
                     <label for="uploadFile"><img src="../assets/imgs/upload.png" /></label>
                     <input type="file" name="uploadFile" id="uploadFile" />
                 </form>
             </div>
         </div>
     </div>
     <div class="form-group" align="right">
         <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
     </div>
 </div>


 <script>
$(document).ready(function() {


    Pusher.logToConsole = true;

    var pusher = new Pusher('504e1e3617aac7eed5cc', {
        cluster: 'ap1'
    });
    var channel = pusher.subscribe('Chat');

    channel.bind('getStatus', function(data) {
        var nameUser = data['message']['nameUser'];
        var statusUser = data['message']['statusUser'];

        let tr;
        tr +=
            '<div style="height:40px " class = "d-flex justify-content-around align-items-center mb-2">';
        tr += '<p style = "width:200px ;font-size: 25px; font-weight: 200px" class= "m-0 p-0">';
        tr += nameUser;
        tr += '</p>';
        tr += '<div style="width:60px; height:30px; ">';
        tr += statusUser;
        tr += '</div>';

        // $('#user_details').append(tr);

    });

    getUser();
    // setInterval(function() {
    //     getUser();
    //     update_chat_history_data();
    //     fetch_group_chat_history();
    // }, 3000);

    function getUser() {
        $.ajax({
            url: "function/getUser.php",
            method: "POST",
            success: function(data) {
                $('#user_details').html(data);
            }
        })
    }


    // t???o h???p nh???n tin
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
        modal_content += '</div><div class="form-group d-flex justify-content-between" align="right">';
        modal_content += '<button type="button" name="send_chat" idUser="' + to_idUser +
            '" class="btn btn-info send_chat">G???i</button></div></div>';
        $('#user_model_details').html(modal_content);
    }


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

    $(document).on('click', '.send_chat', function() {
        var to_idUser = $(this).attr('idUser');
        var message = $.trim($('#message_' + to_idUser).val());
        if (message != '') {

           

    });



            // $.ajax({
            //     url: "function/insertChat.php",
            //     method: "POST",
            //     data: {
            //         to_idUser: to_idUser,
            //         message: message,
            //     },
            //     success: function(data) {
            //         var element = $('#message_' + to_idUser).emojioneArea();
            //         element[0].emojioneArea.setText('');
            //         $('#chat_history_' + to_idUser).html(data);
            //     }
            // })
        } else {
            alert('B???n ch??a vi???t tin nh???n!');
        }
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

    function update_chat_history_data() {
        $('.chat_history').each(function() {
            var to_idUser = $(this).data('touserid');
            print_chat_history(to_idUser);
            console.log(to_idUser);
        });
    }

    $(document).on('click', '.remove_Mess', function() {
        var idMessage = $(this).attr('id');
        if (confirm("B???n ch???c ch???c mu???n thu h???i tin nh???n n??y?")) {
            $.ajax({
                url: "function/deleteMessage.php",
                method: "POST",
                data: {
                    idMessage: idMessage
                },
                success: function(data) {
                    update_chat_history_data();
                }
            })
        }
    });

    $('#group_chat_dialog').dialog({
        autoOpen: false,
        width: 400
    });

    $('#group_chat').click(function() {
        $('#group_chat_dialog').dialog('open');
        $('#is_active_group_chat_window').val('yes');
        fetch_group_chat_history();
    });

    $('#send_group_chat').click(function() {
        var message = $('#group_chat_message').html();
        var action = 'insert_data';
        if (message != '') {
            $.ajax({
                url: "function/group_chat.php",
                method: "POST",
                data: {
                    message: message,
                    action: action
                },
                success: function(data) {
                    $('#group_chat_message').html('');
                    $('#group_chat_history').html(data);
                }
            })
        } else {
            alert('B???n ch??a vi???t tin nh???n!');
        }

    });

    function fetch_group_chat_history() {
        var group_chat_dialog_active = $('#is_active_group_chat_window').val();
        var action = "fetch_data";
        if (group_chat_dialog_active == 'yes') {
            $.ajax({
                url: "function/group_chat.php",
                method: "POST",
                data: {
                    action: action
                },
                success: function(data) {
                    $('#group_chat_history').html(data);
                }
            })
        }
    }

    $('#uploadFile').on('change', function() {
        $('#uploadImage').ajaxSubmit({
            target: "#group_chat_message",
            resetForm: true
        });
    });

}); 
</script>