<?php
session_start();
if (isset($_POST['submit'])) {
$_SESSION['forgot']=TRUE;
$user = $_POST['uname'];
$con = new mysqli('localhost','root','Aditya@1999','brokfree'); //The Aditya@1999 is the password for your mysql server.
$sql = "select * from login where uname = '$user'";
$result = $con->query($sql);
$num = $result->num_rows;
if($num!=0){
    $_SESSION['user']=$user;
    $_SESSION['fname']=$row['fname'];
    $_SESSION['lname']=$row['lname'];
    $_SESSION['mob']=$row['mob'];
    $_SESSION['email']=$row['email'];
    $_SESSION['date']=$row['date'];
    $_SESSION['password']=$row['password'];
    $_SESSION['hash']=$row['hash'];
    while($row = $result->fetch_assoc()){
        $fname=$row['fname'];
        $lname=$row['lname'];
        $mob=$row['mob'];
        $email=$row['email'];
        $date=$row['date'];
        $password=$row['password'];
        $hash=$row['hash'];
    }
    $name = $fname . " " . $lname;
    $to = $email;
    $subject = 'Brokfree Signup Verification';
    $link = "";
    $html_message = "
    <h1>Forgot your password $name?</h1>
    <p>Your account has been verified, now you can continue browsing the website.</p>
    <br>
    <p>If you have forgot your username and password just in case...</p>
    <p>------------------------</p>
    <p>Username : $user</p>
    <p>Password : $password</p>
    <p>------------------------</p>
    <br>
    </p>
    <p>Please <a href = 'localhost/Brokfree/php/verify_email.php?email=$email&hash=$hash'>Click here</a> to confirm your account!!</p>
    ";
    $headers = 'From:noreply@localhost'.'\r\n';
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $html_message . "\n\n";
    mail($to,$subject,$message,$headers);
    ob_start();
    $text = "User exists! A mail will be sent for confirmation";
    include "../html/email-verification.html";
    $out = ob_get_clean();
    echo $out;
}
else{
    ob_start();
    $text = "Sorry, no such User Exists!";
    include "../html/thank-you.html";
    $out = ob_get_clean();
    echo $out;
}
$con->close();
}
?>
