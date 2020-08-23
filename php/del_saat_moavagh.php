<?php
if (!isset($_SESSION)) {
  session_start();
}
if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;} 
require_once('../Connections/taradod.php'); 
include("jdf.php");

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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$colname_Record_saat = "-1";
if (isset($_POST['id'])) {
  $colname_Record_saat = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}

mysql_select_db($database_taradod, $taradod);
$query_Record_saat = sprintf("SELECT * FROM saat WHERE idt = %s", $colname_Record_saat);
$Record_saat = mysql_query($query_Record_saat, $taradod) or die(mysql_error());
$row_Record_saat = mysql_fetch_assoc($Record_saat);
$totalRows_Record_saat = mysql_num_rows($Record_saat);

$deleteSQL = sprintf("DELETE FROM saat WHERE idt=%s",
                       GetSQLValueString($colname_Record_saat, "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($deleteSQL, $taradod) or die(mysql_error());
  
  $deleteSQL = sprintf("DELETE FROM saat_khas WHERE id=%s",
                       GetSQLValueString($row_Record_saat['id_darkhast'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($deleteSQL, $taradod) or die(mysql_error());
  header("location: rizkarkard_mah.php");
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>حذف</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<br/>
<br/>
<br/>
<br/><br/>
<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="466" border="0" align="center" cellpadding="1" cellspacing="1" class="yekan3" dir="rtl">
    <tr>
      <td><div align="center">آیا مایل به حذف رکورد می باشید </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">
	  <input type="hidden" name="MM_insert" value="form1">
        <input type="hidden" name="id" value="<?php echo $_GET['i']; ?>" />
        <input name="submit" type="submit" value="بله" />
        <input type="button" name="Button" value="خیر" onclick="history.back(-1)" />
      </div></td>
    </tr>
  </table>
</form>

</body>
</html>
