<?php
    require_once 'connectDB.php';
    require __DIR__ . '/vendor/autoload.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            'c00e39137b24e507165c',
            '927d2e94a477c2f9a8ed',
            '1256278',
            $options
          );

          $data['statusUser'] = '1';
          $data['nameUser'] = 'Nguyễn Ngọc';
    
          $pusher->trigger('My-Chat', 'get-user', $data);
        }
        else {
          echo "Error: <br>";
        }
  

?>