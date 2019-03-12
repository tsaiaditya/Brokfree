<?php
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$new_pass = $_POST['newpassword'];
$con = new mysqli('localhost','root','Aditya@1999','brokfree');
$sql = "select * from login where uname = '$user' and password = '$pass'";
$result = $con->query($sql);
if($result->num_rows==0)
    echo "no user found";
else {
    $sql = "update login set password = '$new_pass' where uname = '$user'";
    $con->query($sql);
    ob_start();
    include "../html/change-confirm.html";
    $out=ob_get_clean();
    echo $out;
}
?>
