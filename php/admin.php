<?php require_once('../Connections/taradod.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;}

$colname_select_user = "-1";
if (isset($_SESSION['melli'])) {
  $colname_select_user = (get_magic_quotes_gpc()) ? $_SESSION['melli'] : addslashes($_SESSION['melli']);
}
mysql_select_db($database_taradod, $taradod);
$query_select_user = sprintf("SELECT * FROM karmand WHERE codemeli = '%s'", $colname_select_user);
$select_user = mysql_query($query_select_user, $taradod) or die(mysql_error());
$row_select_user = mysql_fetch_assoc($select_user);
$totalRows_select_user = mysql_num_rows($select_user);



 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>اطلاعات فردی</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style3 {font-size: 24px; }
.style4 {color: #CC00FF}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="375" border="0" align="center" cellpadding="0" cellspacing="5" class="yekan3">
  <tr>
    <td width="365"><div align="center" class="yekan2">پنل کاربری </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3"><div align="center" class="style1"><a href="sabte_mojadad_goshi.php" >ثبت مجدد  در سامانه </a></div></td>
  </tr>
 <?php  if($row_select_user['semat'] == 1){  ?> 
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"><a href="list_taeed_darkhastha.php">مشاهده و تایید در خواستها</a></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"><a href="select_karbar.php">مشاهده ریز کارکرد پرسنل </a></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td bgcolor="#CCCCCC" class="style3"><div align="center" class="style1"></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1 style3"><a href="taghvim_day.php"></a></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="button" class="back" name="Button" value="برگشت" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" />
    </div></td>
  </tr>
</table>
</body>

</html>
<?php
mysql_free_result($select_user);
?>
