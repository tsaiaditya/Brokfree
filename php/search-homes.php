<?php
session_start();
ob_start();
$text = $_POST['city'];
include("../html/search-homes.html");
$out = ob_get_clean();
echo $out;
?>