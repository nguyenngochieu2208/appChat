<?php
// xl up ảnh

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Bước 1: Tạo thư mục lưu file
    $error = array();
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES['uploadFile']['name']);
    // Kiểm tra kiểu file hợp lệ
    $type_file = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
     print_r( $target_dir);

    $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');   

    if (!in_array(strtolower($type_file), $type_fileAllow)) {
        if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
            echo '<button type="submit" value="ấn vào "><a href="'.$target_file.'">file</a> </button>';
            echo $type_file;


        }
    }
    //Kiểm tra kích thước file dưới 5 mb
    $size_file = $_FILES['uploadFile']['size'];
    if ($size_file > 5242880) {
        $error['uploadFile'] = "File bạn chọn không được quá 5MB";
    }
// Kiểm tra file đã tồn tại trê hệ thống
    // if (file_exists($target_file)) {
    //     $error['uploadFile'] = "File bạn chọn đã tồn tại trên hệ thống";
    // }
//
    if (empty($error)) {
        if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {

           echo '<p><img src="'.$target_file.'" class="img-thumbnail" width="200" height="160" /></p><br />';
            
            

       }else{
            // echo "k thành công";

       }
   }
}
?>