<?php 

if(!empty($_FILES)){
    if(is_uploaded_file($_FILES['uploadFile']['tmp_name'])){
        $_source_path = $_FILES['uploadFile']['tmp_name'];
        $target_path = 'upload/' .$_FILES['uploadFile']['name'];
        if(move_uploaded_file($_source_path, $target_path)){
            echo '
            <p>
                <img src = "'.$target_path.'" class = "img_thumbnail" width = "250" height ="200" />
            </p></br>
            ';
        }
    }   
}

?>
