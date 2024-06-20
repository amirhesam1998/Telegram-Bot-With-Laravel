<?php
define('TOKEN' , '7403119151:AAH0vnrUk8AeTD8LQ1HbtKlvMpwXm3p0ITM');
//                          define syntax
// define(string $constant, mixed $value, bool $case_insensitive);

//                          EXAMPLE
// <?php 
//     define("GREETINGS", "Hello GFG.", true); 
//     echo GREETINGS; 

//                          Output
// Hello GFG.

$url ='https://api.telegram.org/bot'.TOKEN.'/';
//                          Telegram instance Url: https://api.telegram.org/bot123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11/getMe

$admin_id = "97025321";

$get_me = $url.'getMe';
//                          get telegram information bot method

$SayHello = $url.'sendMessage?text=Hi&chat_id='.$admin_id;
//                          send message to telegram bot method

$get_update = $url .'getUpdates';
//                          get message telegram bot


//                          << Applied getMe Method Telegram Bot >>
var_dump($get_me);
//                          var_dump syntax:
// var_dump(var1, var2, ...);
//                          EXAMPLE
// <?php
// $a = 32;
// echo var_dump($a) . "<br>";
// $b = "Hello world!";
// echo var_dump($b) . "<br>";
// $c = 32.5;
// echo var_dump($c) . "<br>";
// $d = array("red", "green", "blue");
// echo var_dump($d) . "<br>";
// $e = array(32, "Hello world!", 32.5, array("red", "green", "blue"));
// echo var_dump($e) . "<br>";
// echo var_dump($a, $b) . "<br>";
//                          Output
// int(32)
// string(12) "Hello world!"
// float(32.5)
// array(3) { [0]=> string(3) "red" [1]=> string(5) "green" [2]=> string(4) "blue" }
// array(4) { [0]=> int(32) [1]=> string(12) "Hello world!" [2]=> float(32.5) [3]=> array(3) { [0]=> string(3) "red" [1]=> string(5) "green" [2]=> string(4) "blue" } }
// int(32) string(12) "Hello world!"


$curl = curl_init($get_me);
//                          curl_init syntax:
// Initialize a cURL session
// curl_init(?string $url = null): CurlHandle|false

curl_setopt($curl ,CURLOPT_RETURNTRANSFER, true);
//                          curl_setopt syntax:
// Set an option for a cURL transfer
// curl_setopt(CurlHandle $handle, int $option, mixed $value): bool
// $handle          => A cURL handle returned by curl_init().
// $option          => The CURLOPT_XXX option to set.
// $value           => The value to be set on option.

$result = curl_exec($curl);
//                          curl_exec syntax:
// Perform a cURL session
// curl_exec(CurlHandle $handle): string|bool
// $handle          => A cURL handle returned by curl_init().

echo "\n";
var_dump($result);


//                          << Applied sendMessage Method Telegram Bot >>
$curl2 = curl_init($SayHello);
curl_setopt($curl2 , CURLOPT_RETURNTRANSFER , true);
$result2 = curl_exec($curl2);
echo "\n";
var_dump($result2);

//                          << Applied getUpdate Method Telegram Bot >>
$curl3 = curl_init($get_update);
curl_setopt($curl3 , CURLOPT_RETURNTRANSFER , true);
$result3 = curl_exec($curl3);
echo "\n";
var_dump($result3);
