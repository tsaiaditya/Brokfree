<?php
session_start();
ob_start();
$hname = $_SESSION['house_name'];
$con = new mysqli('localhost','root','Aditya@1999','brokfree');
$sql = "select * from house where hname = '$hname'";
$result = $con->query($sql);
while($row = $result->fetch_assoc())
{
    $lat = $row['lat'];
    $long = $row['lon'];
    $bedroom = $row['bedroom'];
    $prop_type = $row['house_type'];
    $description = $row['descrip'];
    $furnishing = $row['furnishing'];
    $facing = $row['facing'];
    $water = $row['water'];
    $bathroom = $row['bathroom'];
    $secure = $row['secure'];
    $non_veg = $row['non_veg'];
    $rent = $row['rent'];
    $builtup = $row['builtup'];
    $preferred_tenants = $row['preferred_tenants'];
    $availability = $row['avail'];
    $parking = $row['parking'];
    $age = $row['age'];
    $balcony = $row['balcony'];
    $deposit = $row['deposit'];
    $lift = $row['lift'];
    $gym = $row['gym'];
    $internet = $row['internet'];
    $intercom = $row['intercom'];
    $swimming = $row['swimming_pool'];
    $ac = $row['AC'];
    $club = $row['club_house'];
    $servant = $row['servant_room'];
    $fire = $row['fire_safety'];
    $play_area = $row['play_area'];
    $shopping = $row['shopping_center'];
    $gas = $row['gas'];
    $park = $row['park'];
    $rainwater = $row['water_harvest'];
    $sewage = $row['sewage_treatment'];
    $house_keep = $row['house_keeping'];
    $power = $row['power_backup'];
    $visitor = $row['visitor_parking'];
    
}
include "../html/view-home.html";
$out = ob_get_clean();
echo $out;
?>