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