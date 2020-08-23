<?php 
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
require_once('../Connections/taradod.php');

 $colname_find_usr = "-1";
if (isset($_COOKIE['taradode_company'])) {
  $colname_find_usr = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
mysql_select_db($database_taradod, $taradod);
$query_find_usr = sprintf("SELECT idk FROM karmand WHERE mac = '%s'", $colname_find_usr);
$find_usr = mysql_query($query_find_usr, $taradod) or die(mysql_error());
$row_find_usr = mysql_fetch_assoc($find_usr);
$totalRows_find_usr = mysql_num_rows($find_usr);

if (!isset($_SESSION)) {
  session_start();
}

include_once('../arabdate/arabic.php');
include_once('jdf.php');
//include("athontication.php");

$br = new Arabic('ArDate');
if(($_SESSION['sal']%33)==1 || ($_SESSION['sal']%33)==5 ||($_SESSION['sal']%33)==9 ||($_SESSION['sal']%33)==13 ||($_SESSION['sal']%33)==18 ||($_SESSION['sal']%33)==22 ||($_SESSION['sal']%33)==26 ||($_SESSION['sal']%33)==30 ){$_SESSION['kabise'] =1;}else{$_SESSION['kabise'] =0;}

if(!isset($_SESSION['sal1'])){  $_SESSION['sal1'] =  $_SESSION['sal'];}
$sal = $_SESSION['sal1'];
$mah = $_GET['m'];

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

$shamsi2 = jdate('Y-m-d',jmktime(0,0,0,$_GET['m'],$_GET['r'],$_SESSION['sal1']));
$m = jalali_to_gregorian($_SESSION['sal1'],$_GET['m'],$_GET['r'],'');
if($m[1] < 10){$z ="0";} if($m[2] < 10){$zz ="0";}
$miladi2 = $m[0]."-".$z.$m[1]."-".$zz.$m[2];//jalali_to_gregorian($_SESSION['sal1'],$_GET['m'],$_GET['r'],'-');
$g = gregorian_to_ghamari($m[0],$m[1],$m[2],'');
if($g[1] < 10){$gz ="0";} if($g[2] < 10){$gzz ="0";}
$ghamari2 = $g[0]."-".$gz.$g[1]."-".$gzz.$g[2];//gregorian_to_ghamari($m[0],$m[1],$m[2],'-');

/*echo $shamsi2."<br/>";
echo $miladi2."<br/>";
echo $ghamari2."<br/>";*/
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert1"])) && ($_POST["MM_insert1"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO taghvim (user, tarikh_sabt, zaman_sabt, tarikhe_yaddasht, yaddasht) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($row_find_usr['idk'], "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
					   GetSQLValueString(jdate('h:i:d'), "text"),
					   GetSQLValueString($shamsi2, "text"),
                       GetSQLValueString($_POST['yaddasht'], "text"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());

  $insertGoTo = "taghvim_not.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_yad = "-1";
$colname_yad = $row_find_usr['idk'];

mysql_select_db($database_taradod, $taradod);
$query_yad = sprintf("SELECT id, yaddasht FROM taghvim WHERE `user` = %s and tarikhe_yaddasht = '$shamsi2' ORDER BY id ASC", $colname_yad);
$yad = mysql_query($query_yad, $taradod) or die(mysql_error());  
$row_yad = mysql_fetch_assoc($yad);
$totalRows_yad = mysql_num_rows($yad);


mysql_select_db($database_taradod, $taradod);
$query_monasebat = "SELECT monasebat FROM monasebat WHERE  tarikh = '$shamsi2' ORDER BY id ASC";
$monasebat = mysql_query($query_monasebat, $taradod) or die(mysql_error());  
$row_monasebat = mysql_fetch_assoc($monasebat);
$totalRows_monasebat = mysql_num_rows($monasebat);

mysql_select_db($database_taradod, $taradod);
$query_monasebat2 = "SELECT monasebat FROM monasebat WHERE  tarikh = '$miladi2' ORDER BY id ASC";
$monasebat2 = mysql_query($query_monasebat2, $taradod) or die(mysql_error());  
$row_monasebat2 = mysql_fetch_assoc($monasebat2);
$totalRows_monasebat2 = mysql_num_rows($monasebat2);

mysql_select_db($database_taradod, $taradod);
$query_monasebat3 = "SELECT monasebat FROM monasebat WHERE  tarikh = '$ghamari2' ORDER BY id ASC";
$monasebat3 = mysql_query($query_monasebat3, $taradod) or die(mysql_error());  
$row_monasebat3 = mysql_fetch_assoc($monasebat3);
$totalRows_monasebat3 = mysql_num_rows($monasebat3);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تقویم رو میزی</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}

-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>

<div align="center" class="font1">
<?php
if($_GET['m']==1){ echo $_SESSION['sal1']." فروردین";}
if($_GET['m']==2){ echo $_SESSION['sal1']." اردیبهشت";}
if($_GET['m']==3){ echo $_SESSION['sal1']." خرداد";}
if($_GET['m']==4){ echo $_SESSION['sal1']." تیر";}
if($_GET['m']==5){ echo $_SESSION['sal1']." مرداد";}
if($_GET['m']==6){ echo $_SESSION['sal1']." شهریور";}
if($_GET['m']==7){ echo $_SESSION['sal1']." مهر";}
if($_GET['m']==8){ echo $_SESSION['sal1']." آبان";}
if($_GET['m']==9){ echo $_SESSION['sal1']." آذر";}
if($_GET['m']==10){ echo $_SESSION['sal1']." دی";}
if($_GET['m']==11){ echo $_SESSION['sal1']." بهمن";}
if($_GET['m']==12){ echo $_SESSION['sal1']." اسفند";}

?>
</div>
<table width="498" height="344" border="0" align="center">
  <tr>
    <td height="80"><table width="97%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" bgcolor="#0066FF"><div align="center"><span class="style2"><?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],$_GET['r'],$_SESSION['sal1']));
		 ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#97D9F9"><div align="center"><?php echo  $_GET['r']; ?></div></td>
      </tr>
      <tr>
        <td width="50%" bgcolor="#80B8E1"><div align="center"> <?php $miladi =  jalali_to_gregorian($sal,$mah,$_GET['r'],'');?>
          <?php echo date('M - Y/m/d',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div></td>
        <td width="50%" bgcolor="#99CCCC"><div align="center">
		<?php echo $br->date('Y/m/d - M',mktime(0,0,0,$miladi[1],($miladi[2]-1),$miladi[0]));		
		?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="115"><form id="form1" name="form1" method="post" action="">
      <table width="97%" height="63%"  border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <tr>
          <td height="70" bgcolor="#0066FF"><div align="center">
              <textarea name="yaddasht" cols="50"></textarea>
          </div></td>
        </tr>
        <tr>
          <td bgcolor="#80B8E1"><div align="center">
              <input type="hidden" name="MM_insert1" value="form1" />
              <input type="submit" name="Submit2" value="ثبت" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td height="22">&nbsp;</td>
  </tr>
  <tr>
    <td height="8">      <table width="97%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#0066FF" dir="rtl" id="t">
        <?php do { ?>
        <tr>
          <td><span class="style27"><a href="show_list.php?m=<?php echo $_GET['m'];?>&r=<?php echo $_GET['r'];?>&n=<?php echo $_GET['n'];?>&recordID=<?php echo $row_yad['id'];?>"><?php echo $row_yad['yaddasht']; ?></a></span></td>
        </tr>
        <?php } while ($row_yad = mysql_fetch_assoc($yad)); ?>
      </table></td>
  </tr>
  <tr>
    <td height="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="20">      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#97D9F9" dir="rtl" id="t">
        <?php do { ?>
        <tr>
          <td><span class="style26 style25"><span class="style24 style26 "><?php echo $row_monasebat['monasebat']; ?></span></span></td>
        </tr>
        <?php } while ($row_monasebat = mysql_fetch_assoc($monasebat)); ?>
      </table>
	   <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#80B8E1" dir="rtl" id="t">
        <?php do { ?>
        <tr>
          <td><span class="style26 style22"><span class="style26 style25"><span class="style26 style28"><span class="style24 style26"><?php echo $row_monasebat2['monasebat']; ?></span></span></span></span></td>
        </tr>
        <?php } while ($row_monasebat2 = mysql_fetch_assoc($monasebat2)); ?>
      </table>
	   <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#99CCCC" dir="rtl" id="t">
        <?php do { ?>
        <tr>
          <td><span class="style29"><?php echo $row_monasebat3['monasebat']; ?></span></td>
        </tr>
        <?php } while ($row_monasebat3 = mysql_fetch_assoc($monasebat3)); ?>
      </table></td>
  </tr>
</table>
<br/>
<div align="center">
  <input name="Submit" type="submit" onclick="MM_goToURL('parent','taghvim_roz.php?m=<?php echo $_GET['m'];?>&n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value="بازگشت" />
</div>

</body>
</html>
<?php
mysql_free_result($yad);
mysql_free_result($monasebat);
mysql_free_result($monasebat2);
mysql_free_result($monasebat3);
?>
