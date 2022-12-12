<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyChat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <?php require_once "connectDB.php" ?>


    <?php 

    $gmailphoneUser = null;
    $passUser = null;

    if(isset($_POST["login"])){
        $gmailphoneUser = $_POST['gmailphoneUser'] ;
        $pass = $_POST['passUser'];
        $passUser = md5($pass);

    }

    

    if($gmailphoneUser != null  && $passUser != null){
        $sql = "SELECT * FROM inforuser WHERE gmailUser = '$gmailphoneUser' OR phoneUser = '$gmailphoneUser' AND passUser = '$passUser' ";
        $data = $conn->query($sql);
        $kq = $data->fetch();

        if($kq == false){
            echo '<script type ="text/JavaScript">';  
            echo 'alert("THÔNG TIN ĐĂNG NHẬP SAI")';  
            echo '</script>';  
        }


        elseif(($gmailphoneUser == $kq['gmailUser'] || $gmailphoneUser == $kq['phoneUser'] ) && $passUser == $kq['passUser'] )
        {
            header("location: appChat.php");
        }
    }

?>


    <div class="container">
        <div style="background-color: #FFF0F5 ;border-radius: 20px;" class="row main-form">
            <div style="border-radius: 20px;" class="m-0 g-0 p-0 col-lg-8 col-12 col-sm-12 image">
                <img style="border-radius: 20px;" class="w-100 h-100" src="../assets/imgs/anhlogin.png" alt="">
            </div>
            <div class="col-lg-4 col-12 col-sm-12 form-login">
                <h1 class="text-center mt-2">Login MyChat</h1>
                <form class="pt-lg-2 mt-lg-5" method="POST" action="">
                    <div class="mb-3">
                        <label for="floatingInput">Gmail or Phone Number</label>
                        <input name="gmailphoneUser" type="text" class="mt-2 form-control bg-light" id="floatingInput"
                            placeholder="Gmail or phone number">
                    </div>

                    <div class="">
                        <label for="floatingPassword">Password</label>
                        <input name="passUser" type="password" class="mt-2 form-control bg-light" id="floatingPassword"
                            placeholder="Password">
                    </div>
                    <div class="d-flex flex-column justify-content-end">
                        <div class="d-flex justify-content-end mt-3"><input class="form-control bg-primary text-white"
                                type="submit" name="login" value="Login"></div>
                        <a class="d-flex justify-content-end text-decoration-none mt-2" href="registerUser.php">Create an
                            account!</a>
                    </div>
                </form>
            </div>

        </div>
    </div>


</body>

</html>