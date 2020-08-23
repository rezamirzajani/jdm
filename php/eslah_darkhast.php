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

if (isset($_SESSION['karbar'])) {
$colname_check_use = (get_magic_quotes_gpc()) ? $_SESSION['karbar'] : addslashes($_SESSION['karbar']);
}elseif(isset($_COOKIE['taradode_company'])) {
$colname_check_use = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}

mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = "SELECT idk FROM karmand WHERE mac = '$colname_check_use'";
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);
$taeed = 1;
$engheza = 1;
if($_POST['eslah'] == 1){$noe_darkhast = 100;}
if($_POST['eslah'] == 2){$noe_darkhast = 101;}
$modat = $_POST['id'];
$tarikh_darkhasti = $row_Record_saat['tarikh'];
if($_POST['saat']!="" && $_POST['daghighe']!=""){$zaman_darkhasti = $_POST['saat'].":".$_POST['daghighe'].":00";}
$insertSQL = sprintf("INSERT INTO saat_khas (idk, noe_darkhast, tarikh_sabt, zaman_sabt, tarikh_darkhast, zaman_darkhast,modat, tozihat, taeed, engheza, goshi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_check_use['idk'], "int"),
                       GetSQLValueString($noe_darkhast, "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
                       GetSQLValueString(jdate('H:i:s'), "text"),
                       GetSQLValueString($tarikh_darkhasti, "text"),
                       GetSQLValueString($zaman_darkhasti, "text"),
					   GetSQLValueString($modat, "text"),
                       GetSQLValueString($_POST['tozihat'], "text"),
                       GetSQLValueString($taeed, "int"),
					   GetSQLValueString($engheza, "int"),
					   GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die('<br/><br/><div align="center" style="color:cc00ff; font-size:24px;">'.$masage.'لطفا تمام موارد را تکمیل فرمایید<br/><br/><input type="button" name="Button" value="بازگشت" onclick="history.back(-1)"/><br/><br/></div>');
 header("location: sabt_saat_moavagh.php?d=1");
 }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>اصلاح ساعت</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body onload="select_noe2()">
<p>&nbsp; </p>
  <?php if(isset($_GET['d'])){?>
<div align="center" class="yekan2"> درخواست شما ثبت شد<br/><br/> 
  <input type="button" name="Button" value="بازگشت" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" />
</div>
<?php exit;} ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="660" align="center" dir="rtl" class="yekan3">
    <tr valign="baseline">
      <td colspan="4" align="right" nowrap><div align="center" class="yekan2">ثبت درخواست اصلاح </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap><div align="right">اینجانب درخواست 
        <select name="eslah" id="eslah" onchange="select_noe2()">
          <option></option>
		  <option value="1">اصلاح</option>
          <option value="2">حذف</option>
        </select> 
        ساعت ردیف <?php echo $_GET['i']; ?> را دارم 
          <input type="hidden" name="hiddenField" />
          <input type="hidden" name="hiddenField2" />
      </div></td>
    </tr>
    <tr valign="baseline" id="eslah_saat" style="visibility:hidden">
      <td width="160" align="right" nowrap><div align="left">ساعت در خواستی: </div></td>
      <td colspan="2"><select name="daghighe">
          <option value=""></option>
          <?php $i = 0; for($i; $i <= 59; $i++){ ?>
          <option value="<?php if($i > 9){echo $i;}else{echo "0".$i;} ?>"  <?php if(jdate('i') == $i ){echo 'selected="selected"';} ?>>
          <?php if($i > 9){echo $i;}else{echo "0".$i;}?>
          </option>
          <?php }?>
        </select>
        <select name="saat">
          <option value=""></option>
          <?php $i = 0; for($i; $i <= 23; $i++){ ?>
          <option value="<?php if($i > 9){echo $i;}else{echo "0".$i;}?>"  <?php if(jdate('H') == $i){echo 'selected="selected"';} ?>>
          <?php if($i > 9){echo $i;}else{echo "0".$i;} ?>
          </option>
          <?php } ?>
        </select></td>
    </tr>
 <!--   <tr valign="baseline" id="trmodat">
      <td colspan="2" align="right" nowrap> <div align="center">(در موارد مورد نیاز  ثبت شود بسته به نوع درخواست بر اساس ساعت یا روز) </div></td>
    </tr>-->
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><div align="left">علت در خواست:</div></td>
      <td width="331"><textarea name="tozihat" cols="50" rows="5"></textarea></td>
      <td width="149">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" valign="top" nowrap><div align="center">(فیلد توضیحات را حتما تکمیل فرمایید وعلت درخواست را کامل توضیح دهید ) </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td colspan="2"><input name="submit" type="submit" value="ثبت"  onmousedown="checkMelliCode()"/>
      <input type="button" name="Button" value="انصراف" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3" align="right" nowrap> <div align="center" id="ms"></div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
   <input type="hidden" name="id" value="<?php echo $_GET['i']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>



