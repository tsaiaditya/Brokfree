<?php
session_start();
ob_start();
include "../html/posting-ads.html";
$out = ob_get_clean();
echo $out;
?>
