<?php require_once('../Connections/taradod.php'); ?>
<?php
$colname_karmand = "-1";
if (isset($_COOKIE['mac'])) {
  $colname_karmand = (get_magic_quotes_gpc()) ? $_COOKIE['mac'] : addslashes($_COOKIE['mac']);
}
mysql_select_db($database_taradod, $taradod);
$query_karmand = sprintf("SELECT * FROM karmand WHERE mac = '%s'", $colname_karmand);
$karmand = mysql_query($query_karmand, $taradod) or die(mysql_error());
$row_karmand = mysql_fetch_assoc($karmand);
$totalRows_karmand = mysql_num_rows($karmand);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ویرایش مشخصات</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($karmand);
?>
