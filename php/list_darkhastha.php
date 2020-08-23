<?php
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
 require_once('../Connections/taradod.php');
 
$colname_select_karmand = "-1";
if (isset($_COOKIE['taradode_company'])) {
  $colname_select_karmand = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
/*mysql_select_db($database_taradod, $taradod);
$query_select_karmand = sprintf("SELECT idk FROM karmand WHERE mac = '%s'", $colname_select_karmand);
$select_karmand = mysql_query($query_select_karmand, $taradod) or die(mysql_error());
$row_select_karmand = mysql_fetch_assoc($select_karmand);
$totalRows_select_karmand = mysql_num_rows($select_karmand);
*/
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_darkhastha = 20;
$pageNum_list_darkhastha = 0;
if (isset($_GET['pageNum_list_darkhastha'])) {
  $pageNum_list_darkhastha = $_GET['pageNum_list_darkhastha'];
}
$startRow_list_darkhastha = $pageNum_list_darkhastha * $maxRows_list_darkhastha;

//$colname_list_saat = $row_select_karmand['idk'];
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_list_darkhastha = "SELECT * FROM saat_khas inner join noe_darkhast on noe_darkhast = idn inner join karmand on karmand.idk = saat_khas.idk WHERE karmand.mac = '$colname_select_karmand' ORDER BY id DESC";
$query_limit_list_darkhastha = sprintf("%s LIMIT %d, %d", $query_list_darkhastha, $startRow_list_darkhastha, $maxRows_list_darkhastha);
$list_darkhastha = mysql_query($query_limit_list_darkhastha, $taradod) or die(mysql_error());
$row_list_darkhastha = mysql_fetch_assoc($list_darkhastha);

if (isset($_GET['totalRows_list_darkhastha'])) {
  $totalRows_list_darkhastha = $_GET['totalRows_list_darkhastha'];
} else {
  $all_list_darkhastha = mysql_query($query_list_darkhastha);
  $totalRows_list_darkhastha = mysql_num_rows($all_list_darkhastha);
}
$totalPages_list_darkhastha = ceil($totalRows_list_darkhastha/$maxRows_list_darkhastha)-1;

$queryString_list_darkhastha = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_list_darkhastha") == false && 
        stristr($param, "totalRows_list_darkhastha") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_list_darkhastha = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_list_darkhastha = sprintf("&totalRows_list_darkhastha=%d%s", $totalRows_list_darkhastha, $queryString_list_darkhastha);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>لیست درخواستها</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table border="0" align="center" cellpadding="1" cellspacing="1" dir="rtl">
  <tr bgcolor="#CC33CC" class="yekan5">
    <td><div align="center" class="style1">کد</div></td>
    <td><div align="center" class="style1">درخواست</div></td>
    <td><div align="center" class="style1">تاریخ ثبت</div></td>
    <td><div align="center" class="style1">زمان ثبت</div></td>
    <td><div align="center" class="style1">تاریخ </div></td>
    <td><div align="center" class="style1">ساعت</div></td>
    <td><div align="center" class="style1">مدت</div></td>
    <td><div align="center" class="style1">توضیحات</div></td>
    <td><div align="center" class="style1">تایید</div></td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC" class="yekan6">
      <td><?php echo $row_list_darkhastha['id']; ?></td>
      <td><?php echo $row_list_darkhastha['onvan']; ?></td>
      <td><?php echo $row_list_darkhastha['tarikh_sabt']; ?></td>
      <td><?php echo $row_list_darkhastha['zaman_sabt']; ?></td>
      <td><?php echo $row_list_darkhastha['tarikh_darkhast']; ?></td>
      <td><?php echo $row_list_darkhastha['zaman_darkhast']; ?></td>
      <td><?php echo $row_list_darkhastha['modat']; ?></td>
      <td><?php echo $row_list_darkhastha['tozihat']; ?></td>
      <td><?php 
	  if($row_list_darkhastha['taeed'] == 1){echo "در حال بررسی";}
	  if($row_list_darkhastha['taeed'] == 2){echo "تایید";}
	  if($row_list_darkhastha['taeed'] == 3){echo "عدم تایید";}
	  ?></td>
    </tr>
    <?php } while ($row_list_darkhastha = mysql_fetch_assoc($list_darkhastha)); ?>
</table>
<p>
<table border="0" width="33%" align="center">
  <tr bgcolor="#CCCCCC">
    <td width="23%" align="center"><?php if ($pageNum_list_darkhastha > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_darkhastha=%d%s", $currentPage, 0, $queryString_list_darkhastha); ?>">&lt;&lt;&lt;&lt;</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_list_darkhastha > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_list_darkhastha=%d%s", $currentPage, max(0, $pageNum_list_darkhastha - 1), $queryString_list_darkhastha); ?>">&lt;&lt;</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_list_darkhastha < $totalPages_list_darkhastha) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_darkhastha=%d%s", $currentPage, min($totalPages_list_darkhastha, $pageNum_list_darkhastha + 1), $queryString_list_darkhastha); ?>">&gt;&gt;</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_list_darkhastha < $totalPages_list_darkhastha) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_list_darkhastha=%d%s", $currentPage, $totalPages_list_darkhastha, $queryString_list_darkhastha); ?>">&gt;&gt;&gt;&gt;</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
<p align="center">
  <input type="button" class="back" name="Button" value="بازگشت" onclick="MM_goToURL('parent','info.php');return document.MM_returnValue" />
</p>
</body>
</html>
<?php
mysql_free_result($list_darkhastha);
?>
