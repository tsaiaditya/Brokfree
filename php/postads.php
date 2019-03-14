<?php
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

        
        $con = new mysqli('localhost','root','','brokfree');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO house VALUES('$city','$latitude','$longitude','$hname','$addr','$description','$furnish_type','$direction','$water_supply','$no_of_bathrooms','$security','$non_veg_allowance','$lift_facility','$airconditioner','$swimming_pool','$servant_room','$gas_pipeline','$sewage_treatment','$visitor_parking','$gym_facility','$club_house','$child_play_area','$park','$house_keeping','$internet','$intercom','$fire_safety','$shopping','$rainwater_harvesting','$power_backup','$rentpm','$sqft','$deposit','$no_of_bedrooms','$prop_type','$tenant_type','$possession_type','$parking_type','$building_age','')";
        if ($conn->query($sql) === TRUE) {
            echo "Data Inserted";// move to alert page
        } else {
            echo "Data not sucessfully inserted";
        }
        
        $conn->close();

    }



?>