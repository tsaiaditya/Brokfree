<?php
session_start();
ob_start();
include "../html/view-home.html";
$out = ob_get_clean();
echo $out;
?>