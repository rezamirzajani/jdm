<?php require_once('../Connections/taradod.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
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
$colname_check_use = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = "SELECT * FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where mac = '$colname_check_use'";
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);
}else{
  $colname_check_use1 = (get_magic_quotes_gpc()) ? $_POST['code_meli'] : addslashes($_POST['code_meli']);
  $colname_check_use2 = (get_magic_quotes_gpc()) ? $_POST['pass'] : addslashes($_POST['pass']);
  $colname_check_use2 = md5($colname_check_use2 );
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = "SELECT * FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where codemeli = '$colname_check_use1' and pass = '$colname_check_use2'";
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);
}
if($row_check_use['idk'] == "" ){$masage = "کد ملی یا کلمه عبور وارد شده معتبر نیست <br/>";}
if($_POST['noe_darkhast'] == 10){
$colname_darkhast_goshi = 1;
mysql_select_db($database_taradod, $taradod);
$query_darkhast_goshi = sprintf("SELECT * FROM saat_khas WHERE noe_darkhast = 10 and engheza = '%s' and idk = '%s'", $colname_darkhast_goshi, $row_check_use['idk']);
$darkhast_goshi = mysql_query($query_darkhast_goshi, $taradod) or die(mysql_error());
$row_darkhast_goshi = mysql_fetch_assoc($darkhast_goshi);
$totalRows_darkhast_goshi = mysql_num_rows($darkhast_goshi);
}
if($totalRows_darkhast_goshi == 0){
if($_POST['noe_darkhast'] != 13){$_POST['jaygozin'] = 0;}
if($_POST['modat1'] != "" && $_POST['modat2'] != "" &&( $_POST['noe_darkhast'] == 3  || $_POST['noe_darkhast'] == 5 || $_POST['noe_darkhast'] == 8  || $_POST['noe_darkhast'] == 9 || $_POST['noe_darkhast'] == 13)){
$modat = $_POST['modat1'].":".$_POST['modat2'];
}
if($_POST['modat1'] != "" && $_POST['modat2'] != "" &&( $_POST['noe_darkhast'] == 4  || $_POST['noe_darkhast'] == 6)){
$modat = $_POST['modat1'];
}
if($_POST['noe_darkhast'] == 1  || $_POST['noe_darkhast'] == 2 || $_POST['noe_darkhast'] == 10  || $_POST['noe_darkhast'] == 11 || $_POST['noe_darkhast'] == 12){$modat = "0";}

if($_POST['sal']!="" && $_POST['mah']!="" && $_POST['roz']!=""){$tarikh_darkhast = $_POST['sal']."-".$_POST['mah']."-".$_POST['roz'];}
if($_POST['saat']!="" && $_POST['daghighe']!=""){$zaman_darkhast = $_POST['saat'].":".$_POST['daghighe'].":00";}
$taeed = 1;
$engheza = 1;

$insertSQL = sprintf("INSERT INTO saat_khas (idk, idj, noe_darkhast, tarikh_sabt, zaman_sabt, tarikh_darkhast, zaman_darkhast,modat, tozihat, taeed, engheza, goshi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_check_use['idk'], "int"),
					   GetSQLValueString($_POST['jaygozin'], "int"),
                       GetSQLValueString($_POST['noe_darkhast'], "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
                       GetSQLValueString(jdate('H:i:s'), "text"),
                       GetSQLValueString($tarikh_darkhast, "text"),
                       GetSQLValueString($zaman_darkhast, "text"),
					   GetSQLValueString($modat, "text"),
                       GetSQLValueString($_POST['tozihat'], "text"),
                       GetSQLValueString($taeed, "int"),
					   GetSQLValueString($engheza, "int"),
					   GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><br/><br/><div align="center" style="color:cc00ff; font-size:24px;">'.$masage.'لطفا تمام موارد را تکمیل فرمایید<br/><br/><input type="button" name="Button" value="بازگشت" onclick="history.back(-1)"/><br/><br/></div>');

mysql_select_db($database_taradod, $taradod);
$query_end_darkhast = "SELECT id FROM saat_khas ORDER BY id DESC";
$end_darkhast = mysql_query($query_end_darkhast, $taradod) or die(mysql_error());
$row_end_darkhast = mysql_fetch_assoc($end_darkhast);
$totalRows_end_darkhast = mysql_num_rows($end_darkhast);

///////////////////////////////////////////////////////////////////

if($_POST['noe_darkhast'] == 3 || $_POST['noe_darkhast'] == 5 || $_POST['noe_darkhast'] == 8 || $_POST['noe_darkhast'] == 9 || $_POST['noe_darkhast'] == 4 || $_POST['noe_darkhast'] == 6){


if($_POST['noe_darkhast'] == 3 || $_POST['noe_darkhast'] == 5 || $_POST['noe_darkhast'] == 8 || $_POST['noe_darkhast'] == 9){


$temp1 = jmktime($_POST['saat'] ,$_POST['daghighe'] ,00 ,$_POST['mah'],$_POST['roz'],$_POST['sal']);
$temp2 = jmktime(16 ,00 ,00 ,$_POST['mah'],($_POST['roz']),$_POST['sal']);
$temp31 = $_POST['modat1']*60*60;
$temp32 = $_POST['modat2']*60;
$temp3 = $temp31 + $temp32;
$temp4 = $temp2 - $temp1;
$temp5 = $temp3 - $temp4;
if($temp3 > $temp4){
$con = 2;
}else{
$con = 1;
} 
}  
if($_POST['noe_darkhast'] == 4 || $_POST['noe_darkhast'] == 6){

$temp1 = jmktime($_POST['saat'] ,$_POST['daghighe'] ,00 ,$_POST['mah'],$_POST['roz'],$_POST['sal']);
$temp2 = jmktime(16 ,00 ,00 ,$_POST['mah'],($_POST['roz']),$_POST['sal']);
$temp31 = 8*60*60;//8 ro bayad az saat kari bekhone
//$temp32 = $_POST['modat2']*60;
$temp3 = $temp31;
$temp4 = $temp2 - $temp1;
$temp5 = $temp3 - $temp4;
if($temp3 > $temp4){
$con =  $modat+1; 
}else{
$con = $modat;
} 
}   

  for($i=0;$i<$con;$i++){
  if($con == 1){
  if($_POST['noe_darkhast'] == 4 || $_POST['noe_darkhast'] == 6){
  $modat = "8:00";
  }else{
  $modat = $_POST['modat1'].":".$_POST['modat2'];
  }}
  if($con > 1){
  if($i == 0 && $temp3 > $temp4){ $modatt = $temp4/60/60; $modatt = explode(".",$modatt); $modatt[1]="0.".$modatt[1]; $modat = $modatt[0].":".round($modatt[1]*60);
  }elseif(($i+1)== $con && $temp3 > $temp4){$modattt = $temp5/60/60; $modattt = explode(".",$modattt); $modattt[1]="0.".$modattt[1]; $modat = $modattt[0].":".round($modattt[1]*60);
  }else{$modat = "8:00";}
  }
$tarikh_darkhast = jdate('Y-m-d',jmktime(0,0,0,$_POST['mah'],($_POST['roz']+$i),$_POST['sal']));
  
  $insertSQL = sprintf("INSERT INTO list_riz_darkhast (idd, idk, idj, l_noe_darkhast, l_tarikhdarkhast, l_zamandarkhast, l_modat) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_end_darkhast['id'], "int"),
					   GetSQLValueString($row_check_use['idk'], "int"),
					   GetSQLValueString($_POST['jaygozin'], "int"),
                       GetSQLValueString($_POST['noe_darkhast'], "int"),
                       GetSQLValueString($tarikh_darkhast, "text"),
                       GetSQLValueString($zaman_darkhast, "text"),
					   GetSQLValueString($modat, "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die('no');
  }
  }
///////////////////////////////////////////////////////////////////////
if($_POST['noe_darkhast']==1 || $_POST['noe_darkhast']==2 || $_POST['noe_darkhast']==11 || $_POST['noe_darkhast']==12){

  if($_POST['noe_darkhast'] == 1 || $_POST['noe_darkhast'] == 11){$noe_t=1;}
  if($_POST['noe_darkhast'] == 2 || $_POST['noe_darkhast'] == 12){$noe_t=2;}

  
    $insertSQL = sprintf("INSERT INTO saat (idk, tarikh, saat, noe, noe_taradod, id_darkhast, taeed) VALUES (%s, %s, %s, %s, %s, %s, 1)",
                       GetSQLValueString($row_check_use['idk'], "int"),
                       GetSQLValueString($tarikh_darkhast, "text"),
                       GetSQLValueString($zaman_darkhast, "text"),
					   GetSQLValueString($row_check_use['idp'], "int"),
					   GetSQLValueString($noe_t, "int"),
					   GetSQLValueString($row_end_darkhast['id'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());
  
  }
  
 header("location: sabt_saat_moavagh.php?d=1");
}else{
echo '<br/><br/><div align="center" style="color:cc00ff; font-size:24px;">شما یک درخواست تغییر گوشی معوق دارید<br/><br/><input type="button" name="Button" value="بازگشت" onclick="history.back(-1)"/><br/><br/></div>'; exit;
}
}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_noe_darkhast = "SELECT * FROM noe_darkhast order by idn asc";
$noe_darkhast = mysql_query($query_noe_darkhast, $taradod) or die(mysql_error());
$row_noe_darkhast = mysql_fetch_assoc($noe_darkhast);
$totalRows_noe_darkhast = mysql_num_rows($noe_darkhast);

mysql_select_db($database_taradod, $taradod);
$query_karman_jaygozin = "SELECT * FROM karmand";
$karman_jaygozin = mysql_query($query_karman_jaygozin, $taradod) or die(mysql_error());
$row_karman_jaygozin = mysql_fetch_assoc($karman_jaygozin);
$totalRows_karman_jaygozin = mysql_num_rows($karman_jaygozin);
echo $_SESSION['tst'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ثبت ساعت معوق</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body onload="select_noe()">
<p>&nbsp; </p>
  <?php if(isset($_GET['d'])){?>
<div align="center" class="yekan2"> درخواست شما ثبت شد<br/><br/> 
  <input type="button" name="Button" value="بازگشت" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" />
</div>
<?php exit;} ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="660" align="center" dir="rtl" class="yekan3">
    <tr valign="baseline">
      <td colspan="4" align="right" nowrap><div align="center" class="yekan2">ثبت درخواست </div></td>
    </tr>
	<?php if (!isset($_COOKIE['taradode_company'])) { ?>
    <tr valign="baseline">
      <td width="160" align="right" nowrap><div align="left">کد ملی کارمند: </div></td>
      <td colspan="3"><input type="text" name="code_meli" id="codemeli" value="" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">کلمه عبور: </div></td>
      <td colspan="3"><input type="password" name="pass" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
	<?php } ?>
    <tr valign="baseline">
      <td nowrap align="right"><div align="left">اینجانب درخواست :</div></td>
      <td colspan="3"><select name="noe_darkhast" id="noe_darkhast" onchange="select_noe()" >
	  <option value="" selected="selected"></option>
        <?php
do {
 if($row_noe_darkhast['idn'] != 100 && $row_noe_darkhast['idn'] != 101){ 
?>

        <option value="<?php echo $row_noe_darkhast['idn']?>"><?php echo $row_noe_darkhast['onvan']?></option>
        <?php }
} while ($row_noe_darkhast = mysql_fetch_assoc($noe_darkhast));
  $rows = mysql_num_rows($noe_darkhast);
  if($rows > 0) {
      mysql_data_seek($noe_darkhast, 0);
	  $row_noe_darkhast = mysql_fetch_assoc($noe_darkhast);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"> <div align="left" id="tarikh">از تاریخ :</div></td>
      <td colspan="3"><select name="roz">
          <option value=""></option>
          <?php 
		$i = 1;
		 for($i; $i <= 31; $i++){ 
		 ?>
          <option value="<?php if($i > 9){echo $i;}else{echo "0".$i;}?>" <?php if(jdate('d') == $i){echo 'selected="selected"';} ?> >
          <?php if($i > 9){echo $i;}else{echo "0".$i;}?>
          </option>
          <?php }?>
        </select>
        <select name="mah">
          <option value=""></option>
          <?php 
		$i = 1;//jdate('n');
		 for($i; $i <= 12; $i++){ ?>
          <option value="<?php if($i > 9){echo $i;}else{echo "0".$i;}?>"  <?php if(jdate('m') == $i){echo 'selected="selected"';} ?>>
          <?php if($i > 9){echo $i;}else{echo "0".$i;}?>
          </option>
          <?php } ?>
        </select>
        <select name="sal">
          <option value="<?php echo jdate('Y')-1; ?>" <?php if($_POST['sal'] == (jdate('Y')-1)){echo 'selected="selected"';} ?>><?php echo jdate('Y')-1; ?></option>
          <option value="<?php echo jdate('Y'); ?>" <?php if($_POST['sal'] == jdate('Y') || !isset($_POST['sal'])){echo 'selected="selected"';} ?>><?php echo jdate('Y'); ?></option>
          <?php if(jdate('m') == 12){ ?>
          <option value="<?php echo jdate('Y')+1; ?>" <?php if($_POST['sal'] == (jdate('Y')+1)){echo 'selected="selected"';} ?>><?php echo jdate('Y')+1; ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr valign="baseline" id="trsaat">
      <td nowrap align="right"><div align="left" id="saat">ساعت:</div></td>
      <td colspan="3"><select name="daghighe">
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
    <tr valign="baseline" id="trmodat" >
      <td nowrap align="right"><div align="left">به مدت :</div></td>
      <td width="121"><select name="modat2" id="modat2">
		<option value="00">00</option>
        <option value="05">05</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
        <option value="30">30</option>
        <option value="35">35</option>
        <option value="40">40</option>
        <option value="45">45</option>
        <option value="50">50</option>
        <option value="55">55</option>
        </select>
        <select name="modat1">
		  <option value="00">00</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
      </select></td>
      <td width="210" ><div align="right" id="noe_zaman">
        <div align="right"></div>
      </div></td>
      <td>&nbsp;</td>
    </tr>
 <!--   <tr valign="baseline" id="trmodat">
      <td colspan="2" align="right" nowrap> <div align="center">(در موارد مورد نیاز  ثبت شود بسته به نوع درخواست بر اساس ساعت یا روز) </div></td>
    </tr>-->
    <tr valign="baseline">
      <td align="right" valign="top" nowrap><div align="left">به علت :</div></td>
      <td colspan="2"><textarea name="tozihat" cols="50" rows="5"></textarea></td>
      <td width="149"> را دارم </td>
    </tr>
    <tr valign="baseline" id="trjaygozin" style="visibility:hidden">
      <td align="right" valign="top" nowrap><div align="left">فرد جایگزین: </div></td>
      <td colspan="2"><select name="jaygozin">
        <?php
do {  
?>
        <option value="<?php echo $row_karman_jaygozin['idk']?>"><?php echo $row_karman_jaygozin['name']?></option>
        <?php
} while ($row_karman_jaygozin = mysql_fetch_assoc($karman_jaygozin));
  $rows = mysql_num_rows($karman_jaygozin);
  if($rows > 0) {
      mysql_data_seek($karman_jaygozin, 0);
	  $row_karman_jaygozin = mysql_fetch_assoc($karman_jaygozin);
  }
?>
      </select>
      </td>
      <td width="149">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="right" valign="top" nowrap><div align="center">(فیلد توضیحات را حتما تکمیل فرمایید وعلت درخواست را کامل توضیح دهید ) </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td colspan="3"><input name="submit" type="submit" value="ثبت"  onmousedown="checkMelliCode()"/>
      <input type="button" name="Button" value="انصراف" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="right" nowrap> <div align="center" id="ms"></div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($karman_jaygozin);
?>


