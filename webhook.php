<?php
include __DIR__ . '/env.php';
include __DIR__ . '/TelegramLib.php';
include __DIR__ . '/Model.php';
include __DIR__ . '/Controller.php';


// TelegramLib::send_message("SAAAALAAAM" , "97025321");

// var_dump(TelegramLib::get_me());


$input = file_get_contents("php://input");

$update = json_decode($input , true);

$controller = new Controller();

$controller->handle($update);


// $updates = TelegramLib::get_update();
// $last_message_id = 0;
// foreach ($updates as $update){
    // $chat_id = $message['message']['chat']['id'];
    // $text = $message['message']['text'];
    // TelegramLib::send_message($text , $chat_id);

//     $controller = new Controller();
//     $controller->handle($update);
//     $last_message_id = $update['update_id'];
// }
// $updates = TelegramLib::get_update($last_message_id + 1);


