<?php require_once "connectDB.php" ?>



<?php 

    $nameUser = null;
    $gmailUser = null;
    $phoneUser = null;
    $passUser =null;

    if(isset($_POST["them"])){
        $nameUser = $_POST["nameUser"];
        $gmailUser = $_POST["gmailUser"];
        $phoneUser = $_POST["phoneUser"];
        $pass = $_POST["passUser"];
        $passUser = md5($pass);

        if($nameUser == null){ echo "Vui lòng nhập tên!\n";}
        if($gmailUser == null){ echo "Vui lòng nhập địa chỉ!\n";}
        if($phoneUser == null){ echo "Vui lòng nhập số điện thoại!\n";}
        if($pass == null){ echo "Vui lòng nhập ngày sinh!\n";}
    }



    



    if($nameUser != "" && $gmailUser != "" && $phoneUser != "" && $passUser != "" ){
        if($gmailUser == $rows['gmailUser']){
            echo '<script type ="text/JavaScript">';  
            echo 'alert("GMAIL NÀY ĐÃ ĐƯỢC ĐĂNG KÝ!")';  
            echo '</script>';  
        }
        elseif($phoneUser == $rows['phoneUser']){
            echo '<script type ="text/JavaScript">';  
            echo 'alert("SỐ ĐIỆN THOẠI NÀY ĐÃ ĐƯỢC ĐĂNG KÝ!")';  
            echo '</script>';  
        }
        else{
            $sql = "INSERT INTO inforuser(nameUser, gmailUser, phoneUser,passUser)
            VALUES ('$nameUser','$gmailUser', '$phoneUser', '$passUser')";
            $kq = $conn->exec($sql);
            if ($kq == 1) echo "Thêm User thành công!";
            else{ echo "Thêm User thất bại!";}

            header("location: loginUser.php");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="content">
    <div class="container">
        <div class="row">
            <form class="col-12 col-sm-12" method="POST">
                <div class="input-group">
                    <span class="input-group-text">Name</span>
                    <input name="nameUser" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
                <div class="input-group">
                    <span class="input-group-text">Gmail</span>
                    <input name="gmailUser" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
                <div class="input-group">
                    <span class="input-group-text">Phone Number</span>
                    <input name="phoneUser" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
                <div class="input-group">
                    <span class="input-group-text">PassWord</span>
                    <input name="passUser" type="password" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
                <div class="button d-flex justify-content-end"><input type="submit" name="them" value="Thêm"></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

