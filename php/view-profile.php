<?php
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="view-profile.css" type = "text/css">
</head>
<body>
    <div class="container">
        <div class="userpicture">
            <i class='fas fa-user-circle' style='font-size:48px;'></i>
        </div>
        <div class="header">
            <label class="heading">YOUR PROFILE</label>
        </div>
        <div class="contents">
            <div class="row">
                <label class="col-4 col-form-label">First Name : </label>
                <p class="col-8" id="fname"><?php echo $_SESSION['fname'];?></p>
            </div>
            <div class="row">
            <label class="col-4 col-form-label">Last Name : </label>
                <p class="col-8" id="lname"><?php echo $_SESSION['lname'];?></p>
            </div>
            <div class="row">
                <label class="col-4 col-form-label">Email : </label>
                <p class="col-8" id="mail"><?php echo $_SESSION['email'];?></p>
            </div>
            <div class="row">
                <label class="col-4 col-form-label">Date Joined : </label>
                <p class="col-8" id="date"><?php echo $_SESSION['date'];?></p>
            </div>
            <div class="row">
                <label class="col-4 col-form-label">Mobile Number : </label>
                <p class="col-8" id="mob_no"><?php echo $_SESSION['mob'];?></p>
            </div>
            <div class="row">
                <label class="col-4 col-form-label">Username : </label>
                <p class="col-8" id="username"><?php echo $_SESSION['user'];?></p>
            </div>
            <a href="change.html" style = "text-decoration : none; color: white; font-size : 16px;">Change passoword?</a>
            <div class="go-to-home">
                <a href="homepage.php">
                <button class="btn btn-danger" style="border-radius: 20px;">Go back to Homepage</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
