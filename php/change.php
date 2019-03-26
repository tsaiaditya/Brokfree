<?php
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$new_pass = $_POST['newpassword'];
$con = new mysqli('localhost','root','Aditya@1999','brokfree'); //instead of Aditya@1999 password for your mysql server.
if($user == $_SESSION['user'])
{
    $sql = "select * from login where uname = '$user' and password = '$pass'";
    $result = $con->query($sql);
    if($result->num_rows==0)
        echo "no user found";
    else {
        $hash = md5($new_pass);
        $sql = "update login set password = '$new_pass' where uname = '$user'";
        $con->query($sql);
        $sql = "update login set hash = '$hash' where uname = '$user'";
        $con->query($sql);
        ob_start();
        $text = "Your password has been updated!";
        include "../html/change-confirm.html";
        $out=ob_get_clean();
        echo $out;
    }
}
else 
{
    ob_start();
    $text = "Username given doesn't match the current user's credentials!";
    include "../html/change-confirm.html";
    $out = ob_get_clean();
    echo $out;
}
$con->close();
?>
