<?php
    session_start();
    if(!empty($_GET['email'])&&!empty($_GET['hash']))
    {
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        $con = new mysqli('localhost','root','Aditya@1999','brokfree');
        $sql = "select * from login where hash = '$hash' and email = '$email'";
        $result = $con->query($sql);
        if($result->num_rows!=0)
        {
            if($_SESSION['forgot']){
                ob_start();
                $text = 'Welcome back to Brokfree!';
                include "../html/thank-you.html";
                $out = ob_get_clean();
                echo $out;
            }
            else{
                ob_start();
                $text = 'Thank You for Signing up in Brokfree!';
                include "../html/thank-you.html";
                $out = ob_get_clean();
                echo $out;
            }
        }
        else 
        {
            ob_start();
            $text = "Error while authentication, no account found!";
            include "../html/email-verification.html";
            $out = ob_get_clean();
            echo $out;
        }
        $con->close();
    }
    else
    {
        ob_start();
        $text = "Wait for the link to be copied from your browsing tab to this browser!";
        include "../html/email-verification.html";
        $out = ob_get_clean();
        echo $out;
    }
?>