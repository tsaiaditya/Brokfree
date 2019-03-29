<?php
session_start();
$min = 0;
$max = 400000;
$rows = 0;
$hname = [];
$rent = [];
$builtup = [];
$deposit = [];
$furnish_arr = [];
$age_arr = [];
$tenant_arr = [];
$avail_arr = [];
$rent_arr = [];
$loc = "";
$bedroom = "";
$family = "";
$parking = "";
$furnish = "";
$message = "";
$sql = "";
$_SESSION['search_homes'] = TRUE;
if (! empty($_POST['min_price'])) {
    $min = $_POST['min_price'];
}
if (! empty($_POST['max_price'])) {
    $max = $_POST['max_price'];
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['bedroom'])&&!empty($_POST['family'])&&!empty($_POST['parking'])&&!empty($_POST['furnish'])) {
        $loc = $_SESSION['city'];
        $bedroom = $_POST['bedroom'];
        $family = $_POST['family'];
        $parking = $_POST['parking'];
        $furnish = $_POST['furnish'];    
        $_SESSION['search_homes'] = TRUE;
        $con = new mysqli('localhost','root','Aditya@1999','brokfree');
        $sql = "select * from house where loc = '$loc' and bedroom = '$bedroom' and preferred_tenants = '$family' and parking = '$parking' and furnishing = '$furnish'"; 
        $result = $con->query($sql);
        if($result->num_rows == 0) {
            $message = "No homes found for the specified...";
            $_SESSION['search_homes'] = FALSE;
        }
        elseif($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $rent = $row['rent'];
                $temp = explode('/',$rent);
                if((int)$temp[0]>=$min && (int)$temp[0]<=$max)
                {   
                    $actual_rent = (int)$temp[0];
                    array_push($hname,$row['hname']);
                    array_push($builtup,$row['builtup']);
                    array_push($deposit,$row['deposit']);
                    array_push($rent_arr,$actual_rent);
                    array_push($age_arr,$row['age']);
                    array_push($furnish_arr,$row['furnishing']);
                    array_push($tenant_arr,$row['preferred_tenants']); 
                    array_push($avail_arr,$row['avail']);  
                    ++$rows;
                }
            }
        }
        $con->close();
        }
    else
    {
        $message = "Please fill all the details in filter...";
        $_SESSION['search_homes'] = FALSE;
    }
}
?>
<!DOCTYPE html>
<html lang="en" style="overflow-y:scroll">

<head>
    <title>Search for Homes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/search-homes.css" types="text/css">
</head>
<style>
    #slider-range {
	width: 80%;
	margin: 6px 0px 6px 0px;
}

</style>
<script>
    /*$(document).ready(function () {
        $('#slider').slider({
            max: 10000, range: true, values: [0, 10000], change: function (event, ui) {
                getDetails(ui.values[0], ui.values[1]);
            }
        });
        var current = $('#slider').slider('option', 'values');
        getDetails(current[0], current[1]);
    });
    function getDetails(minimum, maximum) {
        $('#range').text(" Rs." + minimum + " - Rs." + maximum);
    });
    }*/
    $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 400000,
                values: [ <?php echo $min; ?>, <?php echo $max; ?> ],
            slide: function(event, ui) {
                $("#amount").html("$" + ui.values[0] + " - $" + ui.values[1]);
                $("#min").val(ui.values[0]);
                $("#max").val(ui.values[1]);
            }
        });
        $("#amount").html("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
  });
</script>

<body style="background-color:rgb(238, 114, 13)" onload="document.body.classList.add('loaded')">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../php/homepage.php">BrokFree</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#aboutUs">About Us</a></li>
                    <?php 
                    if(isset($_SESSION['user'])){?>
                    <li><a href="../php/view-profile.php"><span class='fas fa-user-circle' style = 'font-size:18px;'></span><?php echo " ".$_SESSION['user']?></a></li>
                    <li><a href="../php/logout.php">Logout</a></li>
                    <?php }
                    else {?>
                    <li><a href="../html/signup.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="../php/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style = "margin-top:50px;">
        <div class="row">
            <div class="col-md-4">
                <form action="../php/search-homes.php" method="POST">
                    <div class="main-filter">
                        <span class="location">Location Selected : <?php echo $_SESSION['city'];?></span>
                        <span class="filter-panel-header">Apartment Type : </span>
                        <label class="proptype">1 BHK
                            <input type="radio" name="bedroom" value = "1 Bedroom">
                            <span class="checkmark"></span>
                        </label>
                        <label class="proptype">2 BHK
                            <input type="radio" name="bedroom" value = "2 Bedroom">
                            <span class="checkmark"></span>
                        </label>
                        <label class="proptype">3 BHK
                            <input type="radio" name="bedroom" value = "3 Bedroom">
                            <span class="checkmark"></span>
                        </label>
                        <label class="proptype">4 BHK
                            <input type="radio" name="bedroom" value = "4 Bedroom">
                            <span class="checkmark"></span>
                        </label>
                        <div>
                            <span class="filter-panel-header">Price range : </span>
                            <input type="" id="min" name="min_price" value="<?php echo $min; ?>">
                            <div id="slider-range"></div>
                            <input type="" id="max" name="max_price" value="<?php echo $max; ?>">
                        </div>
                        <span class="filter-panel-header">Parking : </span>
                        <label class="avail">Car
                            <input type="radio" name="parking" value = "Car">
                            <span class="checkmark2"></span>
                        </label>
                        <label class="avail">Bike
                            <input type="radio" name="parking" value = "Bike">
                            <span class="checkmark2"></span>
                        </label>
                        <label class="avail">Bike and Car
                            <input type="radio" name="parking" value = "Bike and Car">
                            <span class="checkmark2"></span>
                        </label>
                        <span class="filter-panel-header">Preferred Tenants : </span>
                        <label class="pref-tenant">Family
                            <input type="radio" name="family" value = "Family">
                            <span class="checkmark1"></span>
                        </label>
                        <label class="pref-tenant">Bachelor
                            <input type="radio" name="family" value = "Bachelor">
                            <span class="checkmark1"></span>
                        </label>
                        <label class="pref-tenant">Doesn't Matter
                            <input type="radio" name="family" value="Doesn't matter">
                            <span class="checkmark1"></span>
                        </label>
                        <span class="filter-panel-header">Furnishing Type : </span>
                        <label class="furn">Full
                            <input type="radio" name="furnish" value = "Full">
                            <span class="checkmark3"></span>
                        </label>
                        <label class="furn">Semi
                            <input type="radio" name="furnish" value = "Semi">
                            <span class="checkmark3"></span>
                        </label>
                        <label class="furn">Unfurnished
                            <input type="radio" name="furnish" value = "Unfurnished">
                            <span class="checkmark3"></span>
                        </label>
                        <span class="filter-panel-header">
                            <button type="submit" class="btn btn-warning" name = "submit">Confirmed?</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <?php
                if($_SESSION['search_homes'])
                for($i = 0; $i<$rows; $i++)
                { ?>
                <div class="page-cards">
                    <div class="home-card">
                        <div class="row" style="background-color: lightgrey; padding:5px;">
                            <p class="house-name">
                                <a href="view-home.php" style="text-decoration: none;">
                                <?php 
                                echo $hname[$i]; 
                                $_SESSION['house_name'] = $hname[$i]; ?>
                                </a>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="house-detail">
                                <p>Builtup : <?php echo $builtup[$i]; ?></p>
                            </div>
                            <div class="col-md-4" id="house-detail">
                                <p>Deposit : <?php echo $deposit[$i]; ?></p>
                            </div>
                            <div class="col-md-4" id="house-detail">
                                <p>Rent : <?php echo $rent_arr[$i]; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="color:black">
                                <i class="fa fa-couch" style="font-size:30px"></i>
                                <p>FURNISHING : <?php echo $furnish_arr[$i]; ?></p>
                            </div>
                            <div class="col-md-6" style="color:black">
                                <i class="fa fa-birthday-cake" aria-hidden="true" style="font-size:30px"></i>
                                <p>AGE OF THE BUILDING : <?php echo $age_arr[$i]; ?></p>
                            </div>
                            <div class="col-md-6" style="color:black">
                                <i class="fa fa-user" aria-hidden="true" style="font-size:30px"></i>
                                <p>PREFERRED TENANTS : <?php echo $tenant_arr[$i]; ?></p>
                            </div>
                            <div class="col-md-6" style="color:black">
                                <i class="fa fa-key" aria-hidden="true" style="font-size:30px"></i>
                                <p>AVAILABILITY : <?php echo $avail_arr[$i]; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else
                {?>
                    <div class = "page-cards">
                        <div class = "home-card">
                            <h1><?php echo $message;?></h1>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>