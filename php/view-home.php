<?php
session_start();
ob_start();
$hname = $_SESSION['house_name'];
include "../html/view-home.html";
$out = ob_get_clean();
echo $out;
?>