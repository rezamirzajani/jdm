<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include_once("jdf.php");  
/*$date1 = "2007-03-24 00:00:00";
$date2 = "2009-06-26 00:00:00";
$diff = abs(strtotime($date2) - strtotime($date1));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
printf("%d years, %d months, %d days\n", $years, $months, $days);*/
//$dd = 2*60*60;
$gg = 20*60;
$hh = $dd + $gg;
echo ($hh/60/60)*60;

?>
</body>
</html>
