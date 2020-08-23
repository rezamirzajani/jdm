<?php
if (!isset($_SESSION)) {
  session_start();
} 
require_once('../Connections/taradod.php'); 
//if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
if(isset($_SESSION['melli'])){header("location: admin.php"); exit;} 
if (isset($_POST['codemeli'])) {


$colname_loginuser1 = "-1";
$colname_loginuser2 = "-1";
  $colname_loginuser1 = (get_magic_quotes_gpc()) ? $_POST['codemeli'] : addslashes($_POST['codemeli']);
  $colname_loginuser2 = (get_magic_quotes_gpc()) ? $_POST['pass'] : addslashes($_POST['pass']); $colname_loginuser2 = md5($colname_loginuser2);
  $md = $_POST['codemeli'].$_SERVER['HTTP_USER_AGENT'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_loginuser = sprintf("SELECT * FROM karmand WHERE codemeli = '%s' and pass = '%s'", $colname_loginuser1, $colname_loginuser2);
$loginuser = mysql_query($query_loginuser, $taradod) or die(mysql_error());
$row_loginuser = mysql_fetch_assoc($loginuser);
$totalRows_loginuser = mysql_num_rows($loginuser);


if($totalRows_loginuser == "" ){ 
$erorr =1;
}else{

  $c2 = $row_loginuser ['codemeli'];
 
 $_SESSION['melli'] = $c2;
 $_SESSION['karbar'] = $row_loginuser['mac'];
  header("Location: admin.php" );
  }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ورود</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="login.php">
<table width="401" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl" class="yekan3">
  <tr>
    <td colspan="2"><div align="center" class="yekan2">ورود</div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="135"><div align="right">کد ملی: </div></td>
    <td width="266"><input type="text" name="codemeli" value="" /></td>
  </tr>
  <tr>
    <td><div align="right">کلمه عبور: </div></td>
    <td><input type="password" name="pass" value=""/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="ورود" />
      <input type="button" name="Button" value="انصراف" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <?php if($erorr == 1){ echo "کد ملی یا کلمه عبور اشتباه است";}?>
    </div></td>
    </tr>
</table>
</form>
</body>
</html>
