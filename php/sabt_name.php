<?php require_once('../Connections/taradod.php'); ?>
<?php
//$_SERVER['REMOTE_ADDR'] = "1.1.1.1";
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$h= $_SERVER['REMOTE_ADDR'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_company = "SELECT * FROM ip where ip = '$h'";
$company = mysql_query($query_company, $taradod) or die(mysql_error());
$row_company = mysql_fetch_assoc($company);
$totalRows_company = mysql_num_rows($company);
if($totalRows_company == "" || isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php");}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$colname_check_use = "-1";
if (isset($_POST['codemeli'])) {
  $colname_check_use = (get_magic_quotes_gpc()) ? $_POST['codemeli'] : addslashes($_POST['codemeli']);
}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = sprintf("SELECT name, famili, codemeli FROM karmand WHERE codemeli = '%s'", $colname_check_use);
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);

if($totalRows_check_use > 0){$ms = $row_check_use['name']." ".$row_check_use['famili'].' قبلا ثبت نام کرده اید <br/>';
}elseif($_POST['pass'] != ""){
 $md = $_POST['codemeli'].$_SERVER['HTTP_USER_AGENT'];
  $insertSQL = sprintf("INSERT INTO karmand (jens, name, famili, codemeli, pass, companyid, mac, vasile_sabt) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['jens'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['famili'], "text"),
                       GetSQLValueString($_POST['codemeli'], "text"),
					   GetSQLValueString(md5($_POST['pass']), "text"),
					   GetSQLValueString($_POST['company'], "int"),
                       GetSQLValueString(md5($md ), "text"),
					   GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><br/><br/><div align="center" style="color:cc00ff; font-size:24px;">لطفا تمام موارد را تکمیل فرمایید<br/><br/><input type="button" name="Button" value="بازگشت" onclick="history.back(-1)"/><br/><br/></div>');
  
 $qury_big = "select idk, companyid from karmand order by idk desc limit 0, 1";
  $big = mysql_query($qury_big, $taradod);
  $row_big = mysql_fetch_assoc($big);
  $idk = $row_big['idk'];
  $companyid = $row_big['companyid'];
  
   $insertSQL = "insert into vaset_karman_ip (idkarmand, idip) values ($idk, $companyid)";
   mysql_query('set names "utf8"', $taradod);
   mysql_select_db($database_taradod, $taradod);
   $Result1 = mysql_query($insertSQL, $taradod);
  
  $c1 = md5($md);
  $c2 = $_POST['name']." ".$_POST['famili'];
  
  setcookie("taradode_company", $c1, time()+315360000);
  setcookie("name_famili_user", $c2, time()+315360000);
  header("location: sabt_taradod.php");
}else{ echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><br/><br/><div align="center" style="color:cc00ff; font-size:24px;">لطفا فیلد پسورد را پر نمایید<br/><br/><input type="button" name="Button" value="بازگشت" onclick="history.back(-1)"/><br/><br/></div>'; die;}}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>ثبت نام در سامانه</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<?php 
if(isset($_COOKIE['taradode_company'])){echo '<div align = "center" class = "yekan2">شما قبلا ثبت نام کرده اید</div>'; exit;}
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center" dir="rtl">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><div align="center" class="yekan2">ثبت نام </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">جنسیت:</td>
      <td><select name="jens">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>مرد</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>زن</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">نام:</td>
      <td><input name="name" type="text"  value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">نام خانوادگی :</td>
      <td><input type="text" name="famili" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">کد ملی :</td>
      <td><input type="text" id="codemeli" name="codemeli" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">کلمه عبور: </td>
      <td><input name="pass" type="password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">شرکت : </td>
      <td><select name="company" >
        <?php
do {  
?>
        <option value="<?php echo $row_company['idp']?>"><?php echo $row_company['company']?></option>
        <?php
} while ($row_company = mysql_fetch_assoc($company));
  $rows = mysql_num_rows($company);
  if($rows > 0) {
      mysql_data_seek($company, 0);
	  $row_company = mysql_fetch_assoc($company);
  }
?>
            </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input name="submit" type="submit" value="ثبت" onmousedown="checkMelliCode()" />
	  <input type="button" name="Button" value="انصراف" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2"  align="right" nowrap>&nbsp;
        <div align="center" class="yekan6" id="ms"><?php echo $ms; ?> لطفا جهت تغییر وسیله از قسمت<a href="sabt_saat_moavagh.php"> ثبت درخواستها</a> درخواست خود را ثبت فرمایید<br/>
        در صورتی که قبلا ثبت درخواست داشته اید و درخواست شما تایید شده <a href="refresh_rejester.php">اینجا کلیک </a> فرمایید</div>      </td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p class="yekan6">&nbsp;</p>
</body>
</html>
<?php
//mysql_free_result($check_use);

mysql_free_result($company);
?>

