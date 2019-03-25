<?php
session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $city = $_POST['city'];
        $hname = $_POST['hname'];
        $addr = $_POST['addr'];
        $rentpm = $_POST['rentpm'];
        $sqft = $_POST['sqft'];
        $deposit = $_POST['deposit'];
        $description = $_POST['description'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $no_of_bedrooms = $_POST['no_of_bedrooms'];
        $prop_type = $_POST['prop_type'];
        $tenant_type= $_POST['tenant_type'];
        $possession_type = $_POST['possession_type'];
        $parking_type = $_POST['parking_type'];
        $building_age = $_POST['building_age'];
        $furnish_type = $_POST['furnish_type'];
        $direction = $_POST['direction'];
        $water_supply = $_POST['water_supply'];
        $security = $_POST['security'];
        $no_of_bathrooms = $_POST['no_of_bathrooms'];
        $non_veg_allowance = $_POST['non_veg_allowance'];
        $lift_facility = $_POST['lift_facility'];
        $airconditioner = $_POST['airconditioner'];
        $swimming_pool = $_POST['swimming_pool'];
        $servant_room = $_POST['servant_room'];
        $gas_pipeline = $_POST['gas_pipeline'];
        $sewage_treatment = $_POST['sewage_treatment'];
        $visitor_parking = $_POST['visitor_parking'];
        $gym_facility = $_POST['gym_facility'];
        $club_house = $_POST['club_house'];
        $child_play_area = $_POST['child_play_area'];
        $park = $_POST['park'];
        $house_keeping = $_POST['house_keeping'];
        $internet = $_POST['internet'];
        $intercom = $_POST['intercom'];
        $fire_safety = $_POST['fire_safety'];
        $shopping = $_POST['shopping'];
        $rainwater_harvesting = $_POST['rainwater_harvesting'];
        $power_backup = $_POST['power_backup'];
        $balcony = $_POST['no_of_balconies'];
        $con = new mysqli('localhost','root','Aditya@1999','brokfree');
        $sql = "INSERT INTO house VALUES('$city','$latitude','$longitude','$hname','$addr','$description','$furnish_type','$direction','$water_supply','$no_of_bathrooms','$security','$non_veg_allowance','$lift_facility','$airconditioner','$swimming_pool','$servant_room','$gas_pipeline','$sewage_treatment','$visitor_parking','$gym_facility','$club_house','$child_play_area','$park','$house_keeping','$internet','$intercom','$fire_safety','$shopping','$rainwater_harvesting','$power_backup','$rentpm/M','$sqft','$deposit','$no_of_bedrooms Bedroom','$prop_type','$tenant_type','$possession_type','$parking_type','$building_age years','$balcony')";
        if ($con->query($sql) === TRUE) {
            header('location: ../html/registered.html');
        } else {
            //echo "Data not sucessfully inserted";
            header('location: ../html/signup-login.html');
        }
        $con->close();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/posting-ads.css" type="text/css">
</head>

<body onload="document.body.classList.add('loaded')">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
    
                <a class="navbar-brand" href="../php/homepage.php">BrokFree</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                            if(isset($_SESSION['user'])){?>
                    <li><a href="../php/view-profile.php"><span class='fas fa-user-circle'
                                style='font-size:18px;'></span><?php echo " ".$_SESSION['user']?></a></li>
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
    <form id="regForm" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
        <h1>Posting Ad :</h1>
        <div class="tab">Phase 1:
            <p>
                <input class="normal" placeholder="Name of the city..." oninput="this.className = ''" name="city">
            </p>
            <p>
                <input class="normal" placeholder="Name of the house..." oninput="this.className = ''" name="hname">
            </p>
            <p>
                <input class="normal" placeholder="Full Address..." oninput="this.className = ''" name="addr">
            </p>
            <p>
                <input class="normal" placeholder="Rent per Month..." oninput="this.className = ''" name="rentpm">
            </p>
            <p>
                <input type = "number" class="normal" placeholder="Dimension of land... (in sqft.)" oninput="this.className = ''"
                    name="sqft">
            </p>
            <p>
                <input type = "number" class="normal" placeholder="Deposit Amount(Initial)..." oninput="this.className = ''"
                    name="deposit">
            </p>
            <p>
                <input class="normal" placeholder="Description of the House..." oninput="this.className = ''"
                    name="description">
            </p>
            <p>
                <button onclick="getlocation()" type="button">Click here to find your current location's Latitude and
                    Longitude</button>
            </p>
            <p>
                <input id="lat" class="normal" placeholder="Latitude..." oninput="this.className = ''" name="latitude">
            </p>
            <p>
                <input id="lon" class="normal" placeholder="Longitude..." oninput="this.className = ''"
                    name="longitude">
            </p>
        </div>
        <div class="tab">Phase 2:
            <p>
                <input class="normal" placeholder="Number of Bedrooms in the house..." oninput="this.className = ''" name="no_of_bedrooms">
            </p>
            <p class="radio">Property Type ?<br><br>
                <input class="radio-type" type="radio" name="prop_type" value="Apartment" required>Apartment<br>
                <input class="radio-type" type="radio" name="prop_type" value="Independent House">Individual House<br>  
            </p>
            <p class="radio">Preferred Tenants ?<br><br>
                <input class="radio-type" type="radio" name="tenant_type" value="Family" required>Family<br>  
                <input class="radio-type" type="radio" name="tenant_type" value="Bachelors">Bachelors<br>  
                <input class="radio-type" type="radio" name="tenant_type" value="Company">Company<br>  
                <input class="radio-type" type="radio" name="tenant_type" value="Doesn't Matter">Doesn't matter<br>  
            </p>
            <p class="radio">Possession Type ?<br><br>
                <input class="radio-type" type="radio" name="possession_type" value="Immediately" required>Immediately<br>  
                <input class="radio-type" type="radio" name="possession_type" value="Few Weeks">Few Weeks<br>
            </p>
            <p class="radio">Parking Type ?<br><br>
                <input class="radio-type" type="radio" name="parking_type" value="Bike only" required>Bike only<br>
                <input class="radio-type" type="radio" name="parking_type" value="Bike and Car">Bike and Car<br>
                <input class="radio-type" type="radio" name="parking_type" value="Car only">Car only<br>
            </p>
            <p>
                <input class="normal" placeholder="Age of the Building..." oninput="this.className = ''" name="building_age">
            </p>
            <p class="radio">Furnishing ?<br><br>
                <input class="radio-type" type="radio" name="furnish_type" value="Semi" required>Semi-Furnished<br>
                <input class="radio-type" type="radio" name="furnish_type" value="Full">Fully-Furnished<br>
                <input class="radio-type" type="radio" name="furnish_type" value="Unfurnished">Unfurnished<br>
            </p>
            <p class="radio">Direction in which house is facing ?<br><br>
                <input class="radio-type" type="radio" name="direction" value="North" required>North<br>
                <input class="radio-type" type="radio" name="direction" value="South">South<br>
                <input class="radio-type" type="radio" name="direction" value="East">East<br>
                <input class="radio-type" type="radio" name="direction" value="West">West<br>
            </p>
            <p class="radio">Water Supply getting from ?<br><br>
                <input class="radio-type" type="radio" name="water_supply" value="Corporation" required>Corporation<br>
                <input class="radio-type" type="radio" name="water_supply" value="Borewell">Borewell<br>
                <input class="radio-type" type="radio" name="water_supply" value="Both">Both<br>
            </p>
            <p class="radio">Security Guards ?<br><br>
                <input class="radio-type" type="radio" name="security" value="Yes" required>Yes<br>
                <input class="radio-type" type="radio" name="security" value="No">No<br>
            </p>
            <p>
                <input type = "number" class="normal" placeholder="Number of bathrooms..." oninput="this.className = ''" name="no_of_bathrooms">
            </p>
            <p class="radio">Non-Veg allowed in house ?<br><br>
                <input class="radio-type" type="radio" name="non_veg_allowance" value="Yes" required>Yes<br>
                <input class="radio-type" type="radio" name="non_veg_allowance" value="No">No<br>
            </p>
        </div>
        <div class="tab">Phase 3:
            <p>
                <input type = "number" class="normal" placeholder="Number of balconies..." oninput="this.className = ''" name="no_of_balconies">
            </p>
            <p class="radio">Lift facility ?<br><br>
                <input class="radio-type" type="radio" name="lift_facility" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="lift_facility" value="No" checked>No<br>
            </p>
            <p class="radio">Air Conditioner facility ?<br><br>
                <input class="radio-type" type="radio" name="airconditioner" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="airconditioner" value="No" checked>No<br>
            </p>
            <p class="radio">Swimming Pool ?<br><br>
                <input class="radio-type" type="radio" name="swimming_pool" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="swimming_pool" value="No" checked>No<br>
            </p>
            <p class="radio">Servant room in house ?<br><br>
                <input class="radio-type" type="radio" name="servant_room" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="servant_room" value="No" checked>No<br>
            </p>
            <p class="radio">Gas pipeline for house ?<br><br>
                <input class="radio-type" type="radio" name="gas_pipeline" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="gas_pipeline" value="No" checked>No<br>
            </p>
            <p class="radio">Sewage Treatment plant for house ?<br><br>
                <input class="radio-type" type="radio" name="sewage_treatment" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="sewage_treatment" value="No" checked>No<br>
            </p>
            <p class="radio">Visitor Parking facility ?<br><br>
                <input class="radio-type" type="radio" name="visitor_parking" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="visitor_parking" value="No" checked>No<br>
            </p>
            <p class="radio">Gym facility ?<br><br>
                <input class="radio-type" type="radio" name="gym_facility" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="gym_facility" value="No" checked>No<br>
            </p>
            <p class="radio">Club House ?<br><br>
                <input class="radio-type" type="radio" name="club_house" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="club_house" value="No" checked>No<br>
            </p>
            <p class="radio">Children's Play Area there ?<br><br>
                <input class="radio-type" type="radio" name="child_play_area" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="child_play_area" value="No" checked>No<br>
            </p>
            <p class="radio">Park nearby ?<br><br>
                <input class="radio-type" type="radio" name="park" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="park" value="No" checked>No<br>
            </p>
            <p class="radio">House Keeping Services available?<br><br>
                <input class="radio-type" type="radio" name="house_keeping" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="house_keeping" value="No" checked>No<br>
            </p>
            <p class="radio">Internet Services provided ?<br><br>
                <input class="radio-type" type="radio" name="internet" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="internet" value="No" checked>No<br>
            </p>
            <p class="radio">Intercom provided ?<br><br>
                <input class="radio-type" type="radio" name="intercom" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="intercom" value="No" checked>No<br>
            </p>
            <p class="radio">Fire Safety ensured ?<br><br>
                <input class="radio-type" type="radio" name="fire_safety" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="fire_safety" value="No" checked>No<br>
            </p>
            <p class="radio">Shopping Center Nearby ?<br><br>
                <input class="radio-type" type="radio" name="shopping" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="shopping" value="No" checked>No<br>
            </p>
            <p class="radio">Rainwater Harvesting Facility ?<br><br>
                <input class="radio-type" type="radio" name="rainwater_harvesting" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="rainwater_harvesting" value="No" checked>No<br>
            </p>
            <p class="radio">Power Backup ensured ?<br><br>
                <input class="radio-type" type="radio" name="power_backup" value="Yes">Yes<br>
                <input class="radio-type" type="radio" name="power_backup" value="No" checked>No<br>
            </p>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab
        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            var y = x[n].getElementsByClassName("normal");
            var len = x[n].getElementsByClassName("normal").length;
            var i;
            for (i = 0; i < len; i++) {
                y[i].style.padding = "10px";
                y[i].style.width = "100%";
                y[i].style.fontSize = "17px";
                y[i].style.fontFamily = "Raleway";
                y[i].style.border = "1px solid #aaaaaa";
            }
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }
        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }
        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");

            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }
        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
        var x = document.getElementById("lat");
        var y = document.getElementById("lon");
        function getlocation() {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        function showPosition(position) {
            x.value = position.coords.latitude;
            y.value = position.coords.longitude;
        }
        //var a = document.getElementsByClassName("tab");
        //var b = a[1].getElementsByClassName('radio-type');
        //b.required=true;

    </script>
</body>

</html>

