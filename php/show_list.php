<?php 
require_once('../Connections/taradod.php'); 
 if (!isset($_SESSION)) {
  session_start();
}
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 

 $colname_find_usr = "-1";
if (isset($_COOKIE['taradode_company'])) {
  $colname_find_usr = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
mysql_select_db($database_taradod, $taradod);
$query_find_usr = sprintf("SELECT idk FROM karmand WHERE mac = '%s'", $colname_find_usr);
$find_usr = mysql_query($query_find_usr, $taradod) or die(mysql_error());
$row_find_usr = mysql_fetch_assoc($find_usr);
$totalRows_find_usr = mysql_num_rows($find_usr);



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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE taghvim SET tarikhe_yaddasht=%s, yaddasht=%s WHERE id=%s",
                       GetSQLValueString($_POST['tarikhe_yaddasht'], "text"),
                       GetSQLValueString($_POST['yaddasht'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
if(isset($_GET['r'])){
  $updateGoTo = "taghvim_not.php";
}else{
  $updateGoTo = "list_yaddashtha.php";
  }
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM taghvim WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($deleteSQL, $taradod) or die(mysql_error());

if($_GET['r']==""){
  $deleteGoTo = "list_yaddashtha.php";
}else{
  $deleteGoTo = "taghvim_not.php";
  }
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

/*$colname_up = "-1";
if (isset($_GET['id'])) {
  $colname_up = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_taradod, $taradod);
$query_up = sprintf("SELECT * FROM taghvim WHERE id = %s", $colname_up);
$up = mysql_query($query_up, $taradod) or die(mysql_error());
$row_up = mysql_fetch_assoc($up);
$totalRows_up = mysql_num_rows($up);
*/
$maxRows_DetailRS1 = 15;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

/*$colname_DetailRS1 = "-1";
if (isset($_SESSION['user'])) {
  $colname_DetailRS1 = (get_magic_quotes_gpc()) ? $_SESSION['user'] : addslashes($_SESSION['user']);
}*/
mysql_select_db($database_taradod, $taradod);
$recordID = $_GET['recordID'];
$query_DetailRS1 = sprintf("SELECT * FROM taghvim  WHERE id = $recordID", $colname_yaddasht);
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $taradod) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1">
<table width="480" border="0" align="center" cellpadding="5" cellspacing="0" dir="rtl">
  
  <tr>
    <td width="174" bgcolor="#CADDFB">ردیف</td>
    <td width="288" bgcolor="#CADDFB"><?php echo $row_DetailRS1['id']; ?>
      <input type="hidden" name="id" value="<?php echo $row_DetailRS1['id']; ?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#CADDFB">تاریخ ثبت </td>
    <td bgcolor="#CADDFB"><?php echo $row_DetailRS1['tarikh_sabt']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CADDFB">زمان ثبت </td>
    <td bgcolor="#CADDFB"><?php echo $row_DetailRS1['zaman_sabt']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CADDFB">تاریخ یادآوری </td>
    <td bgcolor="#CADDFB"> <input type="text" name="tarikhe_yaddasht" value="<?php echo $row_DetailRS1['tarikhe_yaddasht']; ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#CADDFB">یادداشت</td>
    <td bgcolor="#CADDFB"><textarea name="yaddasht" cols="35" rows="5"><?php echo $row_DetailRS1['yaddasht']; ?> </textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<?php if(isset($_GET['r'])){?>
	<input name="Submit2" type="button" onclick="MM_goToURL('parent','taghvim_not.php?m=<?php echo $_GET['m'];?>&r=<?php echo $_GET['r'];?>&n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value="بازگشت" />
	<?php }else{ ?>
      <input name="Submit22" type="button" onclick="MM_goToURL('parent','list_yaddashtha.php?n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value="بازگشت" />
	  <?php } ?>
	  
      <input type="submit" name="Submit" value="ویرایش" />
      <input name="Submit3" type="button" ondblclick="MM_goToURL('parent','show_list.php?id=<?php echo $row_DetailRS1['id'];?>&n=<?php echo $_GET['n'];?>&r=<?php echo $_GET['r'];?>&m=<?php echo $_GET['m'];?>&mm=<?php echo $_GET['mm'];?>');return document.MM_returnValue" value="حذف" /></td>
  </tr>
</table>
<input type="hidden" name="MM_update" value="form1">
</form>
</body>
</html><?php
mysql_free_result($DetailRS1);
?>
