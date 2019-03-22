<?php
$headers = "From : tsaiaditya1@gmail.com"."\r\n".
           "MIME Version : 1.0 " . "\r\n".
           "Context-Type : text/html; charset-utf-8";  
$result = mail('tsaiaditya@gmail.com','Sample text','This is just a sample text',$headers);
var_dump($result);
?>