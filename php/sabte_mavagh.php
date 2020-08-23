<?php require_once('../Connections/taradod.php'); ?><?php
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
if (isset($_COOKIE['taradode_company'])) {
$colname_check_use = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = "SELECT * FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where mac = '$colname_check_use'";
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);
if($_POST['saat']!="" && $_POST['daghighe']!=""){$zaman_darkhast = $_POST['saat'].":".$_POST['daghighe'].":00";}
$taeed = 1;
$engheza = 1;
$modat = 0;
$insertSQL = sprintf("INSERT INTO saat_khas (idk, noe_darkhast, tarikh_sabt, zaman_sabt, tarikh_darkhast, zaman_darkhast,modat, tozihat, taeed, engheza, goshi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_check_use['idk'], "int"),
                       GetSQLValueString($_POST['n'], "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
                       GetSQLValueString(jdate('H:i:s'), "text"),
                       GetSQLValueString($_POST['t'], "text"),
                       GetSQLValueString($zaman_darkhast, "text"),
					   GetSQLValueString($modat, "text"),
                       GetSQLValueString($_POST['tozihat'], "text"),
                       GetSQLValueString($taeed, "int"),
					   GetSQLValueString($engheza, "int"),
					   GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod);
  
mysql_select_db($database_taradod, $taradod);
$query_end_darkhast = "SELECT id FROM saat_khas ORDER BY id DESC";
$end_darkhast = mysql_query($query_end_darkhast, $taradod) or die(mysql_error());
$row_end_darkhast = mysql_fetch_assoc($end_darkhast);
$totalRows_end_darkhast = mysql_num_rows($end_darkhast);
  
    $insertSQL = sprintf("INSERT INTO saat (idk, tarikh, saat, noe, noe_taradod, id_darkhast, taeed) VALUES (%s, %s, %s, %s, %s, %s, 1)",
                       GetSQLValueString($row_check_use['idk'], "int"),
                       GetSQLValueString($_POST['t'], "text") ,
                       GetSQLValueString($zaman_darkhast, "text"),
					   GetSQLValueString($row_check_use['idp'], "int"),
					   GetSQLValueString($_POST['n'], "int"),
					   GetSQLValueString($row_end_darkhast['id'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());
  header("location: rizkarkard_mah.php");
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ثبت معوق</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<br/>
<br/>
<br/>
<br/><br/>
<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="656" border="0" align="center" cellpadding="1" cellspacing="1" class="yekan3" dir="rtl">
    <tr>
      <td width="506"><div align="center">اینجانب درخواست ثبت 
          <?php if($_GET['n']==1){ echo "ورود";}if($_GET['n']==2){ echo "خروج";} ?>
          <input type="hidden" name="n" value=" <?php echo $_GET['n'];?>" /> 
      معوق در مورخ </div></td>
      <td width="143"><?php echo  $_GET['t']; ?>
      <input type="hidden" name="t" value="<?php echo  $_GET['t']; ?>" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">ساعت 
         <select name="daghighe">
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
        </select>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">به علت 
          <textarea name="tozihat" cols="50" rows="5"></textarea>
      را دارم </div></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input name="submit" type="submit" value="ثبت"  onmousedown="checkMelliCode()"/>
        <input type="button" name="Button" value="انصراف" onclick="history.back(-1)" />
      </div></td>
    </tr>
  </table>
    <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>

