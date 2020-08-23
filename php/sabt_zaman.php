<?php require_once('../Connections/taradod.php'); ?>
<?php
//$_SERVER['REMOTE_ADDR'] = "1.1.1.1";
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
if(isset($_COOKIE['taradode_company'])){
$c= $_COOKIE['taradode_company'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_ip_check = "SELECT ip, noe FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where mac = '$c'";
$ip_check = mysql_query($query_ip_check, $taradod) or die(mysql_error());
$row_ip_check = mysql_fetch_assoc($ip_check);
$totalRows_ip_check = mysql_num_rows($ip_check);
//echo $_COOKIE['taradode_company']; die;
if($totalRows_ip_check ==""){ echo "لطفا صفحه را مجدد بارگزاری فرمایید"; exit;}
$i=0; do { 

 $arry_ip[$i] = $row_ip_check['ip'];
 $arry_noe[$i] = $row_ip_check['noe'];
 $i++;
 
 } while ($row_ip_check = mysql_fetch_assoc($ip_check));

}else{echo "مرورگر یا وسیله شما تغییر کرده است"; exit;}
 if(in_array($_SERVER['REMOTE_ADDR'], $arry_ip)){
if (isset($_GET["insert"])) {
if (isset($_COOKIE['taradode_company'])) {
  $colname_check_use = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_use = "SELECT idk FROM karmand WHERE mac = '$colname_check_use'";
$check_use = mysql_query($query_check_use, $taradod) or die(mysql_error());
$row_check_use = mysql_fetch_assoc($check_use);
$totalRows_check_use = mysql_num_rows($check_use);

$colname_check_use1 = $_SERVER['REMOTE_ADDR'];
$query_check_use1 = "SELECT idp FROM ip WHERE ip = '$colname_check_use1'";
$check_use1 = mysql_query($query_check_use1, $taradod) or die(mysql_error());
$row_check_use1 = mysql_fetch_assoc($check_use1);
$totalRows_check_use1 = mysql_num_rows($check_use1);

$colname_check_noe_taradod = $row_check_use['idk'];
mysql_select_db($database_taradod, $taradod);
$query_check_noe_taradod = sprintf("SELECT * FROM saat WHERE idk = %s ORDER BY idt DESC", $colname_check_noe_taradod);
$check_noe_taradod = mysql_query($query_check_noe_taradod, $taradod) or die(mysql_error());
$row_check_noe_taradod = mysql_fetch_assoc($check_noe_taradod);
$totalRows_check_noe_taradod = mysql_num_rows($check_noe_taradod);
if($row_check_noe_taradod['noe_taradod'] != $_GET['insert']){
  $insertSQL = sprintf("INSERT INTO saat (idk, tarikh, saat, noe, noe_taradod) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($row_check_use['idk'], "int"),
                       GetSQLValueString(jdate('Y-m-d'), "text"),
                       GetSQLValueString(jdate('H:i:s'), "text"),
                       GetSQLValueString($row_check_use1['idp'], "int"),
					   GetSQLValueString($_GET['insert'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());
  
  
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_check_saat = "SELECT * FROM saat order by tarikh desc, saat desc";
$check_saat = mysql_query($query_check_saat, $taradod) or die(mysql_error());
$row_check_saat = mysql_fetch_assoc($check_saat);
$totalRows_check_saat = mysql_num_rows($check_saat);
  
  }else{echo "<br/>این تردد معتبر نیست<br/>شما قبلا ";
  if($_GET['insert'] == 1){ echo "وارد";}
  if($_GET['insert'] == 2){ echo "خارج";}
   echo" شده اید";}

/*$colname_check_noe_taradod = "-1";
if (isset($_GET['idk'])) {
  $colname_check_noe_taradod = (get_magic_quotes_gpc()) ? $_GET['idk'] : addslashes($_GET['idk']);
}*/
}
}else{echo "شما در مکان مورد نظر نمی باشید"; exit;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ثبت زمان</title>
</head>
<body>
<table width="417" border="0" align="center" cellpadding="0" cellspacing="0" class="yekan2">
  <tr>
    <td width="417"><div align="center"><?php if($row_check_saat['noe_taradod'] == 1){echo "همکار گرامی ورود شما به شرکت را خیر مقدم عرض می نماییم";}elseif($row_check_saat['noe_taradod'] == 2){ echo"همکار گرامی خسته نباشید به امید دیدار";}  ?></div></td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $row_check_saat['tarikh']; ?></div></td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $row_check_saat['saat']; ?></div></td>
  </tr>
</table>


</body>
</html>
<?php
mysql_free_result($check_noe_taradod);
?>

