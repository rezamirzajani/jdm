<?php require_once('../Connections/taradod.php');
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_SESSION['melli'])){
//echo $_SESSION['melli'];
$md = $_SESSION['melli'].$_SERVER['HTTP_USER_AGENT'];
$c = md5($md);
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_sabt_mojadad = "SELECT * FROM karmand WHERE mac = '$c'";
$sabt_mojadad = mysql_query($query_sabt_mojadad, $taradod) or die(mysql_error());
$row_sabt_mojadad = mysql_fetch_assoc($sabt_mojadad);
$totalRows_sabt_mojadad = mysql_num_rows($sabt_mojadad);
if($totalRows_sabt_mojadad == ""){ $error = "وسیله یا نرم افزار مورد استفاده شما تغییر کرده است لطفا درخواست تغییر وسیله ثبت فرمایید";}else{
  $c1 = md5($md);
  $c2 = $row_sabt_mojadad['name']." ".$row_sabt_mojadad['famili'];
  
  setcookie("taradode_company", $c1, time()+315360000);
  setcookie("name_famili_user", $c2, time()+315360000);
 header("location: sabt_taradod.php");

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<title>ثبت مجدد گوشی</title>
</head>

<body>
<div align="center" class="yekan2"><?php echo $error;?></div>
</body>

</html>
<?php
mysql_free_result($sabt_mojadad);
?>
