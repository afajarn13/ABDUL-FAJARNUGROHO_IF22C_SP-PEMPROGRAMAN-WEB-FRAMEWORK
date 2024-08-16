<?php

$data = array(

  "id" => "0",
  "title" => "survey1",
  "description" => "deskripsi1",
  "question" => "question1",
  "type" => "type1",
  "options" => "options1",
  "request_parameter" => "all"
  
);

$url_send ='http://localhost:8080/2/api.php';
$str_data = json_encode($data);

function sendPostData($url, $post){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  $result = curl_exec($ch);
  curl_close($ch);  // Seems like good practice
  return $result;
}

echo " " . sendPostData($url_send, $str_data);

?>