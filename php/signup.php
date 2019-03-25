<?php
session_start();
$_SESSION['forgot']=FALSE;
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mob = $_POST['mob'];
    $password = $_POST['password'];
    $uname = $_POST['uname'];
    $date = date("d/m/Y");
    $hash = md5($password);
    if ((preg_match("/^[a-zA-Z'-]+$/",$fname)) && (preg_match("/^[a-zA-Z'-]+$/",$lname)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (preg_match('/^\d{10}$/',$mob)) && (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) )
    {
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
            $link = "";
            $html_message = "
            <h1>Thank you $name for signing up to our website!</h1>
            <p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>
            <br>
            <p>------------------------</p>
            <p>Username : $uname</p>
            <p>Password : $password</p>
            <p>------------------------</p>
            <br>
            </p>
            <p>Please <a href = 'localhost/Brokfree/php/verify_email.php?email=$email&hash=$hash'>Click here</a> to activate your account!!</p>
            ";
            $headers = 'From:noreply@localhost'.'\r\n';
            $semi_rand = md5(time()); 
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
            $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $html_message . "\n\n";
            mail($to,$subject,$message,$headers);
        }
        else {
            echo "Row not inserted...";
        }
        $con->close();
        }
    }
    else {
        ob_start();
        $text = "The necessary requirements for One or more columns in the signup page weren't met";
        include "../html/thank-you.html";
        $out = ob_get_clean();
        echo $out;
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