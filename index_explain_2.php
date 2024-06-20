<?php
include __DIR__ . '/env.php';
include __DIR__ . '/TelegramLib.php';


define('UPDATE_ID_FILE' , __DIR__."/update_id.txt");

$url ='https://api.telegram.org/bot'.TOKEN.'/';

$admin_id = "97025321";


// $sayHello = $url . 'sendMessage?text=Hi&chat_id=' .$admin_id;

$file = fopen(UPDATE_ID_FILE , 'r');

$last_message_id = fread($file,filesize(UPDATE_ID_FILE));
fclose($file);
$get_update = $url .'getUpdates?offset='.$last_message_id;

$curl = curl_init($get_update);
curl_setopt($curl , CURLOPT_RETURNTRANSFER , true);
$update_result = curl_exec($curl);

$messages = json_decode($update_result , true);
//                      json_decode syntax
// The json_decode() function is used to decode or convert a JSON object to a PHP object.
// json_decode(string, assoc, depth, options)
// string           =>	Required. Specifies the value to be decoded
// assoc            =>	Optional. Specifies a Boolean value. When set to true, the returned object will be converted into an associative array. When set to false, it returns an object. False is default
// depth            =>	Optional. Specifies the recursion depth. Default recursion depth is 512
// options          =>	Optional. Specifies a bitmask (JSON_BIGINT_AS_STRING, JSON_INVALID_UTF8_IGNORE, JSON_INVALID_UTF8_SUBSTITUTE, JSON_OBJECT_AS_ARRAY, JSON_THROW_ON_ERROR)
//                          EXAMPLE
// $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
// $obj = json_decode($jsonobj);
// echo $obj->Peter;
// echo $obj->Ben;
// echo $obj->Joe;

// $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';
// $arr = json_decode($jsonobj, true);
// echo $arr["Peter"];
// echo $arr["Ben"];
// echo $arr["Joe"];

$has_message = false;
foreach ($messages['result'] as $message){
    // $chat_id = $message['message']['chat']['id'];
    // $text = $message['message']['text'];
    
    // $say_thank = $url . 'sendMessage?text=' . $text . '&chat_id='. $chat_id;

    // $curl = curl_init($say_thank);
    // var_dump($say_thank);
    // curl_setopt($curl , CURLOPT_RETURNTRANSFER , true);
    // $update_result = curl_exec($curl);

    $last_message_id = $message['update_id'];
    $has_message = true ;
}
$file = fopen(UPDATE_ID_FILE , 'w+');

fwrite($file,$last_message_id + intval($has_message));
fclose($file);

echo "\n";
echo " your last message id is :" . $last_message_id+1;
// var_dump($messages);