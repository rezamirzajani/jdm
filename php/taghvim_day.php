<?php
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;}
if (!isset($_SESSION)) {
  session_start();
}
require_once('../Connections/taradod.php');
//include("athontication.php");
include_once("jdf.php"); 
include_once('../arabdate/arabic.php');

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

$d=0;
if(isset($_GET['d']) && $_POST['gam'] == ""){
$d = $_GET['d'];
}
if(isset($_POST['gam']) && $_POST['gam']!= "" ){

$_SESSION['d'] = $_POST['gam'];
$d = $_SESSION['d'];
}

$shamsi = jdate('l-d-m-Y', strtotime("+$d day"));
$shamsi2 = jdate('Y-m-d', strtotime("+$d day"));
$miladi = date('Y-m-d-l', strtotime("+$d day"));
$miladi2 = date('Y-m-d', strtotime("+$d day"));
$Ar = new Arabic('ArDate');

$exmilad = explode('-',$miladi);
$rozzm = $exmilad['3'];
$rozm = $exmilad['2'];
$mahm = $exmilad['1'];
$salm = $exmilad['0'];


$ghamari = $Ar->date('Y-m-d',mktime(0,0,0,$mahm,$rozm,$salm));//$Ar->date('Y-m-d',mktime(0,0,0,1,1,2020)); strtotime("+$d day")
$ghamari2 = $Ar->date('Y-m-d',mktime(0,0,0,$mahm,($rozm-1),$salm));

$exshasi = explode('-',$shamsi);
$salf = $exshasi['3'];
$_SESSION['sal'] = $exshasi['3'];
$mahf = $exshasi['2'];
$rozf = $exshasi['1'];
$rozz = $exshasi['0'];
$dd = $d+1;
$shamsii = jdate('l-d-m-Y', strtotime("+$dd day"));
$shamsii2 = jdate('Y-m-d', strtotime("+$dd day"));
$exshasii = explode('-',$shamsii);
$salff = $exshasii['3'];
$mahff = $exshasii['2'];
$rozff = $exshasii['1'];
$rozzz = $exshasii['0'];

$mah_sh = jstrftime('%B',strtotime("+$d day"));
$mah_mi = strftime('%B',strtotime("+$d day"));
$mah_gh = $Ar->date('Y-m-d - M',mktime(0,0,0,$mahm,$rozm,$salm));


if($rozz=="شنبه"){ $r = "السبت";}
if($rozz=="یکشنبه"){ $r = "الأحد";}
if($rozz=="دوشنبه"){ $r = "الاثنين";}
if($rozz=="سه شنبه"){ $r = "الثلاثاء";}
if($rozz=="چهارشنبه"){ $r = "الأربعاء";}
if($rozz=="پنجشنبه"){ $r = "الخميس";}
if($rozz=="جمعه"){ $r = "الجمعة";}

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
	mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());

  $insertGoTo = "taghvim_day.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert2"])) && ($_POST["MM_insert2"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO taghvim (user, tarikh_sabt, zaman_sabt, tarikhe_yaddasht, yaddasht) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($row_find_usr['idk'], "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
					   GetSQLValueString(jdate('h:i:d'), "text"),
					   GetSQLValueString($shamsii2, "text"),
                       GetSQLValueString($_POST['yaddasht2'], "text"));
	mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());

  $insertGoTo = "taghvim_day.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_yad = "-1";
$colname_yad = $row_find_usr['idk'] ;
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_yad = sprintf("SELECT id, yaddasht FROM taghvim WHERE `user` = '%s' and tarikhe_yaddasht = '$shamsi2' ORDER BY id ASC", $colname_yad);
$yad = mysql_query($query_yad, $taradod) or die(mysql_error());  
$row_yad = mysql_fetch_assoc($yad);
$totalRows_yad = mysql_num_rows($yad);


mysql_select_db($database_taradod, $taradod);
$query_yad2 = sprintf("SELECT id, yaddasht FROM taghvim WHERE `user` = '%s' and tarikhe_yaddasht = '$shamsii2' ORDER BY id ASC", $colname_yad);
$yad2 = mysql_query($query_yad2, $taradod) or die(mysql_error());  
$row_yad2 = mysql_fetch_assoc($yad2);
$totalRows_yad2 = mysql_num_rows($yad2);

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
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تقویم رو میزی</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--  
.style8 {color: #FFFFFF; font-size: 50px; }
.style9 {color: #FFFFFF; font-size: 16px; }
.style10 {color: #FFFFFF; font-size: 24px; }
.style11 {color: #FFFFFF; font-size: 30px; }
.style13 {color: #FFFFFF; font-size: 24px; font-weight: bold; }
.style15 {color: #E6E6E6; font-size: 16px; }
.style16 {color: #E6E6E6; font-size: 30px; }
.style17 {color: #E6E6E6; font-size: 50px; }
.style18 {color: #E6E6E6; font-size: 50px; }
.style21 {color: #FFFFFF; font-size: 14px; }
.style22 {font-size: 12px}
.style23 {color: #FFFFFF; font-size: 12px; }
.style24 {color: #0000FF}
#t{
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  -moz-box-shadow: 0px 0px 0px #ffffff;
  -webkit-box-shadow: 0px 0px 0px #ffffff;
  box-shadow: 0px 0px 0px #ffffff;
}
.style25 {font-size: 10px}
.style26 {color: #FFFFFF}
.style27 {color: #0000FF; font-size: 12px; }
.style28 {font-size: 10}
.style29 {color: #FFFFFF; font-size: 10px; }
-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function subm(){
document.getElementById("ff").submit();
}
//-->
</script>
</head>

<body>
<?php
//include('menu.php');

/*
if(isset($_GET['reset'])){
$_SESSION['d'] = NULL;
$_SESSION['rozz'] = NULL;
$_SESSION['rozf'] = NULL;
$_SESSION['roze'] = NULL;
$_SESSION['mahf'] = NULL;
$_SESSION['mahe'] = NULL;
$_SESSION['sale'] = NULL;
$_SESSION['salf'] = NULL;
unset($_SESSION['d']);
unset($_SESSION['rozz']);
unset($_SESSION['rozf']);
unset($_SESSION['roze']);
unset($_SESSION['mahf']);
unset($_SESSION['mahe']);
unset($_SESSION['sale']);
unset($_SESSION['salf']);
}

if(isset($_GET['d']) || isset($_SESSION['d'])){
if(!isset($_SESSION['d']) ){
$_SESSION['d'] = $_GET['d'];
$_SESSION['rozz'] = jdate('N');
$_SESSION['rozf'] = jdate('d');
$_SESSION['roze'] = date('d');
$_SESSION['mahf'] = jdate('m');
$_SESSION['mahe'] = date('m');
$_SESSION['sale'] = date('Y');
$_SESSION['salf'] = jdate('Y');

}
if($_SESSION['mahf'] == 0){$_SESSION['salf'] = $_SESSION['salf']-1;}
if($_SESSION['mahf'] == 13){$_SESSION['salf'] = $_SESSION['salf']+1;}
if(($_SESSION['salf']%33)==1 || ($_SESSION['salf']%33)==5 ||($_SESSION['salf']%33)==9 ||($_SESSION['salf']%33)==13 ||($_SESSION['salf']%33)==18 ||($_SESSION['salf']%33)==22 ||($_SESSION['salf']%33)==26 ||($_SESSION['salf']%33)==30 ){$_SESSION['kabisef'] =1;}else{$_SESSION['kabisef'] =0;}

$_SESSION['rozz'] = $_SESSION['rozz']+$_GET['d'];
if($_SESSION['rozz']==8 ){$_SESSION['rozz'] = 1;}
if($_SESSION['rozz']==0 ){$_SESSION['rozz'] = 7;}
$rozz = $_SESSION['rozz'];

$_SESSION['rozf'] = $_SESSION['rozf']+$_GET['d'];

if($_SESSION['mahf']<7 && $_SESSION['rozf']==32 && $_SESSION['mahf'] !=0 ){$_SESSION['rozf'] = 1; $_SESSION['mahf'] = $_SESSION['mahf']+1;}
if($_SESSION['mahf']<7 && $_SESSION['rozf']==0 && $_SESSION['mahf'] !=0 ){$_SESSION['rozf'] = 31; $_SESSION['mahf'] = $_SESSION['mahf']-1;}

if($_SESSION['mahf']>6 && $_SESSION['rozf']==31 && $_SESSION['mahf'] !=13 && $_SESSION['mahf'] !=12){$_SESSION['rozf'] = 1; $_SESSION['mahf'] = $_SESSION['mahf']+1;}
if($_SESSION['mahf']>6 && $_SESSION['rozf']==0 && $_SESSION['mahf'] !=13 && $_SESSION['mahf'] !=12){$_SESSION['rozf'] = 30; $_SESSION['mahf'] = $_SESSION['mahf']-1;}

if($_SESSION['mahf'] == 12 && $_SESSION['kabisef'] ==0 && $_SESSION['rozf']==30  ){$_SESSION['rozf'] = 1;  $_SESSION['mahf'] = $_SESSION['mahf']+1;}
if($_SESSION['mahf'] == 12 && $_SESSION['kabisef'] ==1 && $_SESSION['rozf']==31  ){$_SESSION['rozf'] = 1;  $_SESSION['mahf'] = $_SESSION['mahf']+1;}
if($_SESSION['mahf'] == 12 && $_SESSION['rozf']==0  ){$_SESSION['rozf'] = 30;  $_SESSION['mahf'] = $_SESSION['mahf']-1;}

if($_SESSION['mahf'] == 0 && $_SESSION['kabisef'] ==0  ){$_SESSION['rozf'] = 29; $_SESSION['mahf'] = 12; $_SESSION['salf'] = $_SESSION['salf']-1;}

if($_SESSION['mahf'] == 0 && $_SESSION['kabisef'] ==1   ){$_SESSION['rozf'] = 30; $_SESSION['mahf'] = 12; $_SESSION['salf'] = $_SESSION['salf']-1;}

if($_SESSION['mahf'] == 13 && $_SESSION['kabisef'] ==0  ){$_SESSION['rozf'] = 1; $_SESSION['mahf'] = 1; $_SESSION['salf'] = $_SESSION['salf']+1;}

if($_SESSION['mahf'] == 13 && $_SESSION['kabisef'] ==1 ){$_SESSION['rozf'] = 1; $_SESSION['mahf'] = 1; $_SESSION['salf'] = $_SESSION['salf']+1;}



 $rozf = $_SESSION['rozf'];
 $mahf = $_SESSION['mahf'];
 $salf = $_SESSION['salf'];
 

}



if(!isset($_GET['d']) && !isset($_SESSION['d'])){
$rozz = jdate('N');
$rozf = jdate('d');
$roze = date('d');
$mahf = jdate('m');
$mahe = date('m');
$sale = date('Y');
$salf = jdate('Y');
}


  
$miladi = jalali_to_gregorian($salf,$mahf,$rozf,' / ');
$exmil =  explode('/',$miladi);
$arab = new Arabic('ArDate');
$arab = $arab-> _hjConvert($exmil[0] ,$exmil[1],$exmil[2],'/');
$ghamari = $arab[0].' / '. $arab[1].' / '. $arab[2];

if(1 >= $mahf &&  $mahf< 7 ){ $day = 31;}elseif($mahf==12 && jdate('L')==0){ $day=29;}else{$day=30;}
if(4<7 ){ $day = 31;}elseif(jdate('m')==12 && jdate('L')==0){ $day=29;}else{$day=30;}

if((jdate('m')+1)<7 ){ $day2 = 31;}elseif(jdate('m')==12 && jdate('L')==0){ $day2=29;}else{$day2=30;}*/
?>

<table width="826" height="422" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50" rowspan="3" bgcolor="#0066FF"><div align="center" class="style15">
      <?php echo $salff;?>
    </div></td>
    <td width="57" rowspan="3" bgcolor="#0066FF"><div align="center" class="style16">
      <?php echo $mahff;?>
    </div></td>
    <td width="101" rowspan="3" bgcolor="#0066FF"><div align="center" class="style17">
      <?php echo $rozff;?>
    </div></td>
    <td width="199" rowspan="3" bgcolor="#0066FF"><div align="center" class="style18">
      <?php echo $rozzz;?>
    </div>      </td>
    <td width="13" rowspan="7" align="center" valign="bottom"><span class="style24">
      <?php echo $_SESSION['d'];?>
    </span></td>
    <td width="47" height="52" bgcolor="#0099FF"><div align="center" class="style9">
      <?php echo $salf;?>
    </div></td>
    <td width="96" bgcolor="#0066FF"><div align="center" class="style11">
      <?php echo $mahf;?>
    </div></td>
    <td width="70" bgcolor="#0000FF"><div align="center" class="style8">
      <?php echo $rozf;?>
    </div></td>
    <td colspan="2" bgcolor="#0066FF"> <div align="center" class="style17">
      <?php echo $rozz;?>
    </div>      </td>
  </tr>
  <tr>
    <td height="21" colspan="2" bgcolor="#003399"><div align="center" class="style21 style22"><?php echo $miladi; ?></div></td>
    <td height="21" colspan="2" bgcolor="#003399"><div align="center" class="style23">
      <?php echo $Ar->date('Y-m-d',mktime(0,0,0,$mahm,$rozm-1,$salm))."-".$r; ?>
    </div></td>
    <td width="113" bgcolor="#003399"><div align="center" class="style23">
      <?php echo $shamsi; ?>
	  
    </div></td>
  </tr>
  <tr>
    <td height="22" colspan="2" bgcolor="#003399"><div align="center" class="style23">
      <?php echo $mah_mi; ?>
    </div></td>
    <td height="22" colspan="2" bgcolor="#003399"><div align="center" class="style23"><?php echo $Ar->date('M',mktime(0,0,0,$mahm,$rozm-1,$salm)); ?></div></td>
    <td width="113" bgcolor="#003399"><div align="center" class="style23">
      <?php echo $mah_sh; ?>
    </div></td>
  </tr>
  <tr>
    <td height="51" colspan="4" valign="middle" bgcolor="#CADDFB"><form id="form2" name="form2" method="post" action="">
      
        <div align="center">
          <input type="hidden" name="MM_insert2" value="form1" />
          <input type="submit" name="Submit2" value="+" />
          <textarea name="yaddasht2" cols="40" rows="3" dir="rtl"></textarea>
        </div>
     </form>    </td>
    <td colspan="5" valign="middle" bgcolor="#CADDFB"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    
        <div align="center">
          <input type="hidden" name="MM_insert1" value="form1" />
          <input type="submit" name="Submit" value="+" />
          <textarea name="yaddasht" cols="40" rows="3" dir="rtl"></textarea>
        </div>
        </form></td>
  </tr>
  <tr>
    <td height="5" colspan="4" bgcolor="#0099FF" class="style25"><div align="center" class="style26">یادداشت</div></td>
    <td height="5" colspan="5" valign="middle" bgcolor="#0099FF" class="style21"><div align="center" class="style25">یادداشت</div></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#CADDFB"><div style="position:relative; height:200px; overflow:auto">
      <table id="t" width="97%" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <?php do { ?>
        <tr>
          <td><span class="style24"><?php echo $row_yad2['yaddasht']; ?></span></td>
        </tr>
        <?php } while ($row_yad2 = mysql_fetch_assoc($yad2)); ?>
      </table>
    </div></td>
    <td height="214" colspan="5" valign="top" bgcolor="#CADDFB"><div style="position:relative; height:200px; overflow:auto">
      <table id="t" width="97%" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <?php do { ?>
        <tr>
          <td><span class="style27"><?php echo $row_yad['yaddasht']; ?></span></td>
        </tr>
        <?php } while ($row_yad = mysql_fetch_assoc($yad)); ?>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#CADDFB">&nbsp;</td>
    <td colspan="5" valign="top" bgcolor="#0000FF"><div style="position:relative; height:50px; overflow:auto">
      <table id="t" width="97%" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <?php do { ?>
        <tr> 
          <td><span class="style26 style25"><span class="style24 style26 "><?php echo $row_monasebat['monasebat']; ?></span></span></td>
        </tr>
        <?php } while ($row_monasebat = mysql_fetch_assoc($monasebat)); ?>
      </table>
	   <table id="t" width="97%" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <?php do { ?>
        <tr>
          <td><span class="style26 style22"><span class="style26 style25"><span class="style26 style28"><span class="style24 style26"><?php echo $row_monasebat2['monasebat']; ?></span></span></span></span></td>
        </tr>
        <?php } while ($row_monasebat2 = mysql_fetch_assoc($monasebat2)); ?>
      </table>
	   <table id="t" width="97%" border="0" align="center" cellpadding="0" cellspacing="0" dir="rtl">
        <?php do { ?>
        <tr>
          <td><span class="style29"><?php echo $row_monasebat3['monasebat']; ?></span></td>
        </tr>
        <?php } while ($row_monasebat3 = mysql_fetch_assoc($monasebat3)); ?>
      </table>
    </div>	</td>
  </tr>
</table>
<br/>
 <form id="ff" name="form3" method="post" action="taghvim_day.php?n=<?php echo $_GET['n'];?>">
<table width="301" height="32" border="0" align="center">
  <tr>
    <td width="73" height="28" bgcolor="#0099FF"><div align="center"><a href="taghvim.php?n=<?php echo $_GET['n'];?>">جستجو</a></div></td>
    <td width="43" bgcolor="#0099FF"><div align="center" class="style13"><a onclick="subm()" href="taghvim_day.php?n=<?php echo $_GET['n'];?>&d=<?php if(isset($_SESSION['d'])){echo $d - $_SESSION['d'];}else{ echo $d-1;} ?>">&lt;</a></div></td>
    <td width="50" valign="middle" bgcolor="#0099FF">
    
	  <div align="center" class="style10">
	    <input id = "gam" name="gam" type="text" size="1"  />
	  </div>
      </td>
    <td width="38" bgcolor="#0099FF"><div align="center" class="style10"><strong><a onclick="subm()" href="taghvim_day.php?n=<?php echo $_GET['n'];?>&d=<?php if(isset($_SESSION['d'])){echo $d + $_SESSION['d'];}else{ echo $d+1;} ?>">&gt;</a></strong></div></td>
    <td width="75" bgcolor="#0099FF"><div align="center"><a href="taghvim_day.php?n=<?php echo $_GET['n'];?>&reset=1">روز جاری </a></div></td>
  </tr>
</table>
</form> 
<div align="center">
  <input name="Submit3" type="submit" onclick="MM_goToURL('parent','info.php');return document.MM_returnValue" value="بازگشت" />
</div>

</body>
</html>
<?php
mysql_free_result($find_usr);

mysql_free_result($yad);
mysql_free_result($yad2);
mysql_free_result($monasebat);
mysql_free_result($monasebat2);
mysql_free_result($monasebat3);
?>
