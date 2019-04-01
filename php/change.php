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
    {
        ob_start();
        $text =  "Credentials for the user doesn't match";
        include "../html/thank-you.html";
        $out = ob_get_clean();
        echo $out;
    }
    else {
        $hash = md5($new_pass);
        $sql = "update login set password = '$new_pass' where uname = '$user'";
        $con->query($sql);
        $sql = "update login set hash = '$hash' where uname = '$user'";
        $con->query($sql);
        $uname=$_SESSION['user'];
        $fname=$_SESSION['fname'];
        $lname=$_SESSION['lname'];
        $email=$_SESSION['email'];
        $password=$_SESSION['password'];
        $name = $fname . " " . $lname;
        $to = $email;
        $subject = 'Brokfree Password change Notification';
        $link = "";
        $html_message = "
            <h1>Hey $name!</h1>
            <p>Looks like your password has been changed, this Mail is to notify you that your current credentials are as follows : </p>
            <br>
            <p>------------------------</p>
            <p>Username : $uname</p>
            <p>Password : $password</p>
            <p>------------------------</p>
            <br>
            </p>
            <p>Thanks for using Brokfree!!</p>
            ";
        $headers = 'From:noreply@localhost'.'\r\n';
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $html_message . "\n\n";
        mail($to,$subject,$message,$headers);
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
