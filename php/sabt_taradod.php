<?php require_once('../Connections/taradod.php'); ?>
<?php
//$_SERVER['REMOTE_ADDR'] = "1.1.1.1";
$arry_ip[0] = 1;
$arry_noe[0] = 0;
//echo $_COOKIE['taradode_company']; die;
if(isset($_COOKIE['taradode_company'])){
$c= $_COOKIE['taradode_company'];

mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_ip_check = "SELECT ip, noe, semat FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where mac = '$c'";
$ip_check = mysql_query($query_ip_check, $taradod) or die(mysql_error());
$row_ip_check = mysql_fetch_assoc($ip_check);
$totalRows_ip_check = mysql_num_rows($ip_check);
if($totalRows_ip_check ==""){ header("location: delet.php?true=ok");}

$i=0; do {  
$arry_ip[$i] = $row_ip_check['ip']; 
$arry_semat[$i] = $row_ip_check['semat'];
$arry_noe[$i] = $row_ip_check['noe'];
$i++;
} while ($row_ip_check = mysql_fetch_assoc($ip_check));

}else{
$h= $_SERVER['REMOTE_ADDR'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_ip_check = "SELECT ip FROM ip where ip = '$h'";
$ip_check = mysql_query($query_ip_check, $taradod) or die(mysql_error());
$row_ip_check = mysql_fetch_assoc($ip_check);
$totalRows_ip_check = mysql_num_rows($ip_check);
}
//echo $row_ip_check['semat'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragram" content="no-cache" />
<meta http-equiv="expires" content="-1"  />
<title>حضور غیاب</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
#Layer8 {
	position:absolute;
	left:55px;
	top:81px;
	width:128px;
	height:104px;
	z-index:2;
}

-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p  class="yekan2" align="center"><a href="login.php">سامانه ثبت ساعت کار </a></p>
<div align="center" class="yekan2"><a href="info.php"> 
  <?php 
  if(isset($_COOKIE['taradode_company']) && in_array($_SERVER['REMOTE_ADDR'], $arry_ip)){echo "!به شرکت خوش آمدید ". $_COOKIE["name_famili_user"] ;} 
  if(isset($_COOKIE['taradode_company']) && !in_array($_SERVER['REMOTE_ADDR'], $arry_ip)){echo "!به امید دیدار شما در شرکت ". $_COOKIE["name_famili_user"] ;} 
  ?>
</a></div>
<div id="Layer1">
<div id="Layer6" align="center" class="yekan2">
<br/>
<input name="yes1" type="button" value="ورود" class="yekan2" style="width:200px; height:130px;" onclick="MM_showHideLayers('Layer7','','show','Layer6','','hide');proccess1()"/>
<br/>
<input name="yes2" type="button" value="خروج" class="yekan2" style="width:200px; height:130px;" onclick="MM_showHideLayers('Layer7','','show','Layer6','','hide');proccess2()"/>
<br/>
<input name="no" type="button" value="انصراف" class="yekan2" style="width:200px; height:130px;" onclick="MM_showHideLayers('Layer2','','show','Layer6','','hide')"/>
</div>
<div id="Layer7" align="center" class="yekan2" onclick="MM_showHideLayers('Layer2','','show','Layer6','','hide','Layer7','','hide');clear('Layer7')"></div>
<div id="Layer2" 
<?php
 if($_SERVER['REMOTE_ADDR'] == $row_ip_check['ip'] || in_array($_SERVER['REMOTE_ADDR'], $arry_ip) ){
 if(isset($_COOKIE['taradode_company'])){echo 'onclick="MM_showHideLayers(\'Layer2\',\'\',\'hide\',\'Layer6\',\'\',\'show\')"';}
 if(!isset($_COOKIE['taradode_company'])){echo 'onclick="MM_goToURL(\'parent\',\'sabt_name.php\');return document.MM_returnValue"';}
 }
 ?> >
  <div align="center" >
    <!--<p class="yekan1">&nbsp;</p>-->
	<br/>
    <p class="yekan1"><?php 
	if($_SERVER['REMOTE_ADDR'] == $row_ip_check['ip'] || in_array($_SERVER['REMOTE_ADDR'], $arry_ip) ){
	if(isset($_COOKIE['taradode_company'])){echo 'ثبت تردد';}
	if(!isset($_COOKIE['taradode_company'])){echo 'ثبت نام';}
	}else{
	//if(in_array(1,$arry_noe) || in_array(0,$arry_noe)){
	echo "شما در مکان مورد نظر نیستید لطفا پس از ورود با وای فای شرکت به اینترنت متصل شوید";}
	//if(in_array(2,$arry_noe)){echo "<br/>چک کردن مختصات";}
	//if(in_array(0,$arry_noe)){echo '<br/><a href="/sabt_name.php">درخواست تغییر گوشی ثبت کنید</a>';}
	//}
	?> </p>
    </div>
</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="yekan2"><a href="sabt_saat_moavagh.php">ثبت درخواست</a> </p>
</body>

</html>
<?php
mysql_free_result($ip_check);
?>