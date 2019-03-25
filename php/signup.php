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

if ((preg_match("/^[a-zA-Z'-]+$/",$fname)) && (preg_match("/^[a-zA-Z'-]+$/",$lname)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (preg_match('/^\d{10}$/',$mob)) && (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) )
{



    $con = new mysqli('localhost','root','Aditya@1999','brokfree'); //The Aditya@1999 is where mysql server's password comes.
    $sql = "select * from login where uname = '$uname'";
    $result = $con->query($sql);
    if($result->num_rows != 0)
    {
        ob_start();
        $text = "User already exists!";
        include "../html/thank-you.html";
        $out = ob_get_clean();
        echo $out;
    }
    else {
    $sql = "insert into login values('$fname','$lname','$email','$mob','$uname','$date','$password')";
    if($con->query($sql)===TRUE){
        $_SESSION['user']=$uname;
        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['email']=$email;
        $_SESSION['mob']=$mob;
        $_SESSION['date']=$date;
        ob_start();
        $text = 'Thank You for Signing up in Brokfree!';
        include "../html/thank-you.html";
        $out = ob_get_clean();
        echo $out;
    }
    else {
        echo "Row not inserted...";
    }
    $con->close();
    }
    else {
        echo "";
    }
}
else
{
    echo "<script>alert ('The Inputs do not match the requirement');</script>"
}
?>
