<?php require_once('../Connections/taradod.php'); ?>
<?php
//$_SERVER['REMOTE_ADDR'] = "1.1.1.1";
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}


$h= $_SERVER['REMOTE_ADDR'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_company = "SELECT * FROM ip where ip = '$h'";
$company = mysql_query($query_company, $taradod) or die(mysql_error());
$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);
if($totalRows_company == "" || isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php");}


if (isset($_POST['codemeli'])) {

//echo $_POST['codemeli'];
$colname_loginuser1 = "-1";
$colname_loginuser2 = "-1";
  $colname_loginuser1 = (get_magic_quotes_gpc()) ? $_POST['codemeli'] : addslashes($_POST['codemeli']);
  $colname_loginuser2 = (get_magic_quotes_gpc()) ? $_POST['pass'] : addslashes($_POST['pass']); $colname_loginuser2 = md5($colname_loginuser2);
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_loginuser = sprintf("SELECT * FROM karmand WHERE codemeli = '%s' and pass = '%s'", $colname_loginuser1, $colname_loginuser2);
$loginuser = mysql_query($query_loginuser, $taradod) or die(mysql_error());
$row_loginuser = mysql_fetch_assoc($loginuser);
$totalRows_loginuser = mysql_num_rows($loginuser);
if($totalRows_loginuser == "" ){ $erorr =1;}else{
$colname_darkhast_goshi = 1;
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_darkhast_goshi = sprintf("SELECT * FROM saat_khas WHERE noe_darkhast = 10 and taeed =2 and engheza = '%s' and idk = '%s'", $colname_darkhast_goshi, $row_loginuser['idk']); 
$darkhast_goshi = mysql_query($query_darkhast_goshi, $taradod) or die(mysql_error());
$row_darkhast_goshi = mysql_fetch_assoc($darkhast_goshi);
$totalRows_darkhast_goshi = mysql_num_rows($darkhast_goshi); 
if($totalRows_darkhast_goshi == "" ){ $erorr =2;}
 } 
  
  if ($totalRows_darkhast_goshi !="") {
  $vasile = $_SERVER['HTTP_USER_AGENT'];
  $md = $row_loginuser ['codemeli'].$_SERVER['HTTP_USER_AGENT'];
  $c1 = md5($md);
  $c2 = $row_loginuser ['name']." ".$row_loginuser ['famili'];
  
  setcookie("taradode_company", $c1, time()+315360000);
  setcookie("name_famili_user", $c2, time()+315360000);	
  
 $updateSQL = "UPDATE saat_khas SET engheza='2' WHERE noe_darkhast = 10 and taeed=2 and engheza='1' and idk=".$row_loginuser['idk'];                     
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error()); 
  
  $updateSQL = "UPDATE karmand SET mac='$c1', vasile_sabt='$vasile' WHERE idk=".$row_loginuser['idk'];                     
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());    
if(isset($_SESSION['karbar'])){$_SESSION['karbar'] = $c1;}

  header("Location: /sabt_taradod.php" );
  }else { 
  header("Location: /refresh_rejester.php?erorr=".$erorr);
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ثبت مجدد</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="refresh_rejester.php">
<table width="607" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
  <tr>
    <td colspan="2"><div align="center" class="yekan2">ثبت مجدد در سیستم </div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="135"><div align="left">کد ملی: </div></td>
    <td width="266"><input type="text" name="codemeli" value="" /></td>
  </tr>
  <tr>
    <td><div align="left">کلمه عبور: </div></td>
    <td><input type="password" name="pass" value=""/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="ثبت" />
      <input type="button" name="Button" value="انصراف" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="yekan3">
      <?php if($_GET['erorr'] == 1){ echo "کد ملی یا کلمه عبور اشتباه است";}
	        if($_GET['erorr'] == 2){ echo "شما درخواست تایید شده ای جهت تغییر گوشی ندارید";} 
	   ?>
    </div></td>
    </tr>
</table>
</form>
</body>
</html>

