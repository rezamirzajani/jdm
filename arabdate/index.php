<?php
header("content-type: text/html; charset=utf-8");

include('arabic.php');
include("../php/jdf.php"); 

echo date(' Y', strtotime("+1000 day"));

?>
     
 