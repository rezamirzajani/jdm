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



$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_GET['exitserch'])) &&($_GET['exitserch']=="1")){
  $_SESSION['yaddasht'] = NULL;
  $_SESSION['tarikh'] = NULL;
  $_SESSION['mm'] = NULL;
  unset($_SESSION['yaddasht']);
  unset($_SESSION['tarikh']);
  unset($_SESSION['mm']);

  }

if(isset($_POST['yaddasht'])){
$_SESSION['yaddasht'] = $_POST['yaddasht'];
 }
if(isset($_SESSION['yaddasht'])){
$yad = $_SESSION['yaddasht'];
$w = "and yaddasht like '%$yad%'";

 }
if($_GET['all'] == "1" && isset($_GET['all'])){
$maxRows_yaddasht = 10000;
}else{
$maxRows_yaddasht = 10;
}
$pageNum_yaddasht = 0;
if (isset($_GET['pageNum_yaddasht'])) {
  $pageNum_yaddasht = $_GET['pageNum_yaddasht'];
}
$startRow_yaddasht = $pageNum_yaddasht * $maxRows_yaddasht;

$colname_yaddasht1 = "-1";
$colname_yaddasht2 = "-1";
if (isset($_SESSION['iduser'])) {
  $colname_yaddasht1 = $row_find_usr['idk'];
  
  if(isset($_POST['tarikh']) && $_POST['tarikh']!="") {$_SESSION['tarikh'] = $_POST['tarikh'];}
  if(isset($_GET['mm']) && $_GET['mm']!=""){  
  $r = (get_magic_quotes_gpc()) ? $_GET['mm'] : addslashes($_GET['mm']);
  $s = (get_magic_quotes_gpc()) ? $_SESSION['sal1'] : addslashes($_SESSION['sal1']);
  $_SESSION['mm'] = $s."-".$r;
  }
  if(isset($_SESSION['mm'])){     
  $_SESSION['tarikh'] = NULL;
  unset($_SESSION['tarikh']);  $colname_yaddasht2 =  $_SESSION['mm']; }
  
  if( isset($_SESSION['tarikh'])){
  $colname_yaddasht2 = (get_magic_quotes_gpc()) ? $_SESSION['tarikh'] : addslashes($_SESSION['tarikh']);
  }
  if($_SESSION['tarikh'] == "" && $_SESSION['mm']==""){
  $colname_yaddasht2 = (get_magic_quotes_gpc()) ? $_SESSION['sal1'] : addslashes($_SESSION['sal1']);
}}
mysql_select_db($database_taradods, $taradod);
$query_yaddasht = sprintf("SELECT * FROM taghvim WHERE `user` = %s and tarikhe_yaddasht like '%%%s%%' %s order by tarikhe_yaddasht asc", $colname_yaddasht1, $colname_yaddasht2, $w);
$query_limit_yaddasht = sprintf("%s LIMIT %d, %d", $query_yaddasht, $startRow_yaddasht, $maxRows_yaddasht);
$yaddasht = mysql_query($query_limit_yaddasht, $taradod) or die($query_limit_yaddasht);
$row_yaddasht = mysql_fetch_assoc($yaddasht);

if (isset($_GET['totalRows_yaddasht'])) {
  $totalRows_yaddasht = $_GET['totalRows_yaddasht'];
} else {
  $all_yaddasht = mysql_query($query_yaddasht);
  $totalRows_yaddasht = mysql_num_rows($all_yaddasht);
}
$totalPages_yaddasht = ceil($totalRows_yaddasht/$maxRows_yaddasht)-1;

$queryString_yaddasht = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_yaddasht") == false && 
        stristr($param, "totalRows_yaddasht") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_yaddasht = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_yaddasht = sprintf("&totalRows_yaddasht=%d%s", $totalRows_yaddasht, $queryString_yaddasht);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>لیست یادداشت ها</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style1 {color: #6CB1FD}
-->
</style>
</head>

<body>
<?php //include('menu.php');
?>
<table width="811" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CADDFB"><form id="form1" name="form1" method="post" action="">
      <span class="style_m1">
      <input name="Submit22" type="button" onclick="MM_goToURL('parent','list_yaddashtha.php?exitserch=1&n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value=" ←" />
      </span>
      <input type="submit" name="Submit" value="نمایش همه" onclick="MM_goToURL('parent','list_yaddashtha.php?all=1&n=<?php echo $_GET['n']; ?>&mm=<?php echo $_GET['mm'];?>');return document.MM_returnValue" />
      <input type="submit" name="Submit2" value="جستجو" />
      <input type="text" name="yaddasht" value="<?php echo $_SESSION['yaddasht'];?>" />
      تاریخ
    <input type="text" name="tarikh" value="<?php
	 if(isset($_SESSION['tarikh'])){echo $_SESSION['tarikh'];}
	 if(isset($_SESSION['mm'])){ echo $_SESSION['mm'];}
	 if($_SESSION['tarikh']=="" && $_SESSION['mm']==""){ echo $_SESSION['sal1'];}?>" />
    یادداشت
    </form>    </td>
  </tr>
</table>
<br/>
<table width="811" align="center" dir="rtl">
  <tr bgcolor="#CADDFB">
    <td width="89" bgcolor="#6CB1FD"><div align="center">ردیف</div></td>
    <td width="176" bgcolor="#CADDFB"><div align="center">تاریخ </div></td>
    <td width="530"><div align="center">یادداشت</div></td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#E9E9E9">
      <td bgcolor="#6CB1FD"><div align="center"><a href="show_list.php?n=<?php echo $_GET['n'];?>&recordID=<?php echo $row_yaddasht['id']; ?>"> <?php echo $row_yaddasht['id']; ?></a> </div></td>
      <td><div align="center"><?php echo $row_yaddasht['tarikhe_yaddasht']; ?></div></td>
      <td><?php echo $row_yaddasht['yaddasht']; ?>&nbsp; </td>
    </tr>
    <?php } while ($row_yaddasht = mysql_fetch_assoc($yaddasht)); ?>
</table>
<br>

<table width="30%" border="0" align="center" class="style1">
  <tr bgcolor="#6CB1FD">
    <td width="23%" align="center"><?php if ($pageNum_yaddasht > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_yaddasht=%d%s", $currentPage, 0, $queryString_yaddasht); ?>">اولین</a>
          <?php } // Show if not first page ?>    </td>
    <td width="28%" align="center"><?php if ($pageNum_yaddasht > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_yaddasht=%d%s", $currentPage, max(0, $pageNum_yaddasht - 1), $queryString_yaddasht); ?>">قبلی</a>
          <?php } // Show if not first page ?>    </td>
    <td width="26%" align="center"><?php if ($pageNum_yaddasht < $totalPages_yaddasht) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_yaddasht=%d%s", $currentPage, min($totalPages_yaddasht, $pageNum_yaddasht + 1), $queryString_yaddasht); ?>">بعدی</a>
          <?php } // Show if not last page ?>    </td>
    <td width="23%" align="center"><?php if ($pageNum_yaddasht < $totalPages_yaddasht) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_yaddasht=%d%s", $currentPage, $totalPages_yaddasht, $queryString_yaddasht); ?>">آخرین</a>
          <?php } // Show if not last page ?>    </td>
  </tr>
</table>
<div align="center" class="style1">رکورد<?php echo ($startRow_yaddasht + 1) ?> تا <?php echo min($startRow_yaddasht + $maxRows_yaddasht, $totalRows_yaddasht) ?> از <?php echo $totalRows_yaddasht ?></div>
</body>
</html>
<?php
mysql_free_result($yaddasht);
?>
