<?php
$currentPage = $_SERVER["PHP_SELF"];
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
 require_once('../Connections/taradod.php'); ?>
<?php
$colname_select_karmand = "-1";
if (isset($_COOKIE['taradode_company'])) {
  $colname_select_karmand = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
mysql_select_db($database_taradod, $taradod);
$query_select_karmand = sprintf("SELECT idk FROM karmand WHERE mac = '%s'", $colname_select_karmand);
$select_karmand = mysql_query($query_select_karmand, $taradod) or die(mysql_error());
$row_select_karmand = mysql_fetch_assoc($select_karmand);
$totalRows_select_karmand = mysql_num_rows($select_karmand);


$maxRows_list_saat = 20;
$pageNum_list_saat = 0;
if (isset($_GET['pageNum_list_saat'])) {
  $pageNum_list_saat = $_GET['pageNum_list_saat'];
}
$startRow_list_saat = $pageNum_list_saat * $maxRows_list_saat;

$colname_list_saat = $row_select_karmand['idk'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_list_saat = "SELECT * FROM saat left join ip on saat.noe = ip.idp WHERE idk = $colname_list_saat ORDER BY idt DESC";
$query_limit_list_saat = sprintf("%s LIMIT %d, %d", $query_list_saat, $startRow_list_saat, $maxRows_list_saat);
$list_saat = mysql_query($query_limit_list_saat, $taradod) or die(mysql_error());
$row_list_saat = mysql_fetch_assoc($list_saat);

if (isset($_GET['totalRows_list_saat'])) {
  $totalRows_list_saat = $_GET['totalRows_list_saat'];
} else {
  $all_list_saat = mysql_query($query_list_saat);
  $totalRows_list_saat = mysql_num_rows($all_list_saat);
}
$totalPages_list_saat = ceil($totalRows_list_saat/$maxRows_list_saat)-1;

$queryString_list_saat = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_saat") == false && 
        stristr($param, "totalRows_list_saat") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_saat = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_saat = sprintf("&totalRows_list_saat=%d%s", $totalRows_list_saat, $queryString_list_saat);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>لیست های ساعت های ثبت شده</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" align="center" cellpadding="1" cellspacing="1" dir="rtl">
  <tr bgcolor="#CC33CC" class="yekan5">
    <td><div align="center" class="style1">کد</div></td>
    <td><div align="center" class="style1">روز</div></td>
    <td><div align="center" class="style1">ساعت</div></td>
    <td><div align="center" class="style1">شرکت</div></td>
    <td><div align="center" class="style1">تردد</div></td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC" class="yekan6">
      <td><a href="eslahe_saat.php?i=<?php echo $row_list_saat['idt']; ?>"><?php echo $row_list_saat['idt']; ?></a></td>
      <td><?php echo $row_list_saat['tarikh']; ?></td>
      <td><?php echo $row_list_saat['saat']; ?></td>
      <td><?php echo $row_list_saat['company']; ?></td>
      <td><?php if($row_list_saat['noe_taradod'] == 1){echo "ورود";}else{echo "خروج";} ?></td>
    </tr>
    <?php } while ($row_list_saat = mysql_fetch_assoc($list_saat)); ?>
</table>

<p>
<table border="0" width="29%" align="center">
  <tr bgcolor="#CCCCCC">
    <td width="23%" align="center"><?php if ($pageNum_list_saat > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_saat=%d%s", $currentPage, 0, $queryString_list_saat); ?>">&lt;&lt;&lt;&lt;</a>
        <?php } // Show if not first page ?></td>
    <td width="27%" align="center"><?php if ($pageNum_list_saat > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_saat=%d%s", $currentPage, max(0, $pageNum_list_saat - 1), $queryString_list_saat); ?>">&lt;&lt;</a>
        <?php } // Show if not first page ?></td>
    <td width="27%" align="center"><?php if ($pageNum_list_saat < $totalPages_list_saat) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_saat=%d%s", $currentPage, min($totalPages_list_saat, $pageNum_list_saat + 1), $queryString_list_saat); ?>">&gt;&gt;</a>
        <?php } // Show if not last page ?></td>
    <td width="23%" align="center"><?php if ($pageNum_list_saat < $totalPages_list_saat) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_saat=%d%s", $currentPage, $totalPages_list_saat, $queryString_list_saat); ?>">&gt;&gt;&gt;&gt;</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<p align="center">
  <input type="button" class="back" name="Button" value="بازگشت" onclick="MM_goToURL('parent','info.php');return document.MM_returnValue" />
</p>
</body>
</html>
<?php
mysql_free_result($list_saat);

mysql_free_result($select_karmand);
?>
