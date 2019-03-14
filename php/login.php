<?php
session_start();
$user=$pass="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$user = test_input($_POST['uname']);
$pass = test_input($_POST['password']);
$con = new mysqli('localhost','root','Aditya@1999','brokfree'); //The Aditya@1999 is the password for your mysql server.
$sql = "select * from login where uname = '$user' and password = '$pass'";
$result = $con->query($sql);
$num = $result->num_rows;
if($num==0)
{
    echo "";
}
else{
    if($num>0)
    {
        while($row = $result->fetch_assoc())
        {
            $_SESSION['user']=$row['uname'];
            $_SESSION['fname']=$row['fname'];
            $_SESSION['lname']=$row['lname'];
            $_SESSION['mob']=$row['mob'];
            $_SESSION['email']=$row['email'];
            $_SESSION['date']=$row['date'];
            $_SESSION['password']=$row['password'];
        }
    }
    header('location:homepage.php');
}
$con->close();
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;}
?>
<html>
<head>
    <title>Login to Brokfree</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css" type="text/css">
</head>

<body onload="document.body.classList.add('loaded')">
    <div class="container">
        <div class="form">
            <div class="tab-content">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <h1>Welcome Back</h1>
                    <div class="field-wrap">
                        <label>
                            Username<span class="req">*</span>
                        </label>
                        <input type="text" required autocomplete="off" name = "uname">
                    </div>
                    
                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" name = "password">
                    </div>
                    
                    <button class="button button-block" type = 'submit' name = 'submit'>Log In</button>
                    <button class="button button-block" type = 'button' style = "padding : 10px; margin-top : 30px;"><a href = "../html/signup.html" style = "color: white; padding : 5px; text-decoration : none;">Don't have an account? Click here...</a></button>
                </form>
                <h4 style = "color:white;">
                <?php 
                if($user=="")
                    echo "";
                else
                    echo "Invalid password or username, please try again";?></h4>
            </div>
        </div>
    </div> 
    <script>
        $(function () {

            $('.form').find('input, textarea').on('keyup blur focus', function (e) {

                var $this = $(this),
                    label = $this.prev('label');

                if (e.type === 'keyup') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.addClass('active highlight');
                    }
                } else if (e.type === 'blur') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.removeClass('highlight');
                    }
                } else if (e.type === 'focus') {

                    if ($this.val() === '') {
                        label.removeClass('highlight');
                    }
                    else if ($this.val() !== '') {
                        label.addClass('highlight');
                    }
                }

            });
        });
    </script>
</body>
</html>
