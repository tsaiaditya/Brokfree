<?php
session_start();
if(isset($_POST['submit'])){
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$mob = $_POST['mob'];
$password = $_POST['password'];
$uname = $_POST['uname'];
$date = date("d/m/Y");
$hash = md5($password);
$con = new mysqli('localhost','root','Aditya@1999','brokfree'); //The Aditya@1999 is where mysql server's password comes.
$sql = "select * from login where uname = '$uname'";
$result = $con->query($sql);
$sql = "select * from login where fname = '$fname' and lname = '$lname'";
$result1 = $con->query($sql);
if($result->num_rows != 0 || $result1->num_rows != 0)
{
    ob_start();
    $text = "Username already exists!";
    include "../html/thank-you.html";
    $out = ob_get_clean();
    echo $out;
}
else {
$sql = "insert into login values('$fname','$lname','$email','$mob','$uname','$date','$password','$hash')";
if($con->query($sql)===TRUE){
    $_SESSION['user']=$uname;
    $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
    $_SESSION['email']=$email;
    $_SESSION['mob']=$mob;
    $_SESSION['password']=$password;
    $_SESSION['hash']=$hash;
    $_SESSION['date']=$date;
    header('location: verify_email.php');
    $name = $fname . " " . $lname;
    $to = $email;
    $subject = 'Brokfree Signup Verification';
    $message = "
    Thank you $name for signing up to our website!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

    ------------------------
    Username : $uname
    Password : $password
    ------------------------

    Please copy the link below to activate your account : 
    localhost/Brokfree/php/verify_email.php?email=$email&hash=$hash
    ";
    $headers = 'From:noreply@localhost'.'\r\n';
    mail($to,$subject,$message,$headers);
}
else {
    echo "Row not inserted...";
}
$con->close();
}
}
else {
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
</head>
<body>
    <div>
        Wait for the authentication!
    </div>
</body>
</html>