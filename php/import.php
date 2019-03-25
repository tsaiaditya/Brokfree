<?php
$row = 1;
$arr=[];
$con = new mysqli('localhost','root','Aditya@1999','brokfree');
if (($handle = fopen("../housedata.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        $text = "insert into house values(";
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
            if(preg_match("/[a-zA-Z]/",$data[$c]))
                $text .= '"'.$data[$c].'",';    
            else
                $text .= $data[$c].',';
        }
        $len = strlen($text);
        $text[$len-1] = ")";
        if($con->query($text)===TRUE)
            echo "inserted<br>";
        else
            echo "not inserted<br>";
        array_push($arr,$text);
    }
    echo "Table Created"." ".$arr[1];
    fclose($handle);
}
$con->close();
//location,lat,lon,name,address,description,furnishing,facing,water,bathroom,security,non-veg,lift,AC,swimming pool,servant room,gas,sewage treatment,visitor parking,gym,club house,children play area,park,house keeping,internet,intercom,fire safety,shopping center,water harvest,power backup,rent,builtup,deposit,bedroom,house type,preferred tenants,availability,parking,age,balcony
?>