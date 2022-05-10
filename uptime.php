<?php
function ping($host, $port, $timeout) { 
  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return "down"; } 
 return "up"; 
}
//To add extra servers edit this array
$sites=array("127.0.0.1","github.com");
foreach ($sites as $key) {
	$status = ping($key,"80","8080");

 if ($status=="down") {
 	notify($key);
 	echo $status;
}}
  
 function notify($key){
   $text="{$key}  is down";
 	//Enter your telegram token here
$token="";

$json=file_get_contents("https://api.telegram.org/bot$token/getUpdates");
$jsond=json_decode($json,true);
//Getting the chat id 
$chat_id=$jsond['result']['0']['message']['chat']['id'];
$data = [
  //This is the message to be send
   'text' =>$text,
 'chat_id' => $chat_id
];
file_get_contents("https://api.telegram.org/bot$token/sendMessage?" .http_build_query($data) );	
 }

?>
