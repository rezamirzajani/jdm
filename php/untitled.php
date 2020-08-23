<?php require_once('../Connections/taradod.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_taradod, $taradod);
$query_Recordset1 = "SELECT * FROM saat_khas";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $taradod) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<table border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td>id</td>
    <td>idk</td>
    <td>noe_darkhast</td>
    <td>tarikh_sabt</td>
    <td>zaman_sabt</td>
    <td>tarikh_darkhast</td>
    <td>zaman_darkhast</td>
    <td>modat</td>
    <td>tozihat</td>
    <td>taeed</td>
    <td>engheza</td>
    <td>goshi</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['idk']; ?></td>
      <td><?php echo $row_Recordset1['noe_darkhast']; ?></td>
      <td><?php echo $row_Recordset1['tarikh_sabt']; ?></td>
      <td><?php echo $row_Recordset1['zaman_sabt']; ?></td>
      <td><?php echo $row_Recordset1['tarikh_darkhast']; ?></td>
      <td><?php echo $row_Recordset1['zaman_darkhast']; ?></td>
      <td><?php echo $row_Recordset1['modat']; ?></td>
      <td><?php echo $row_Recordset1['tozihat']; ?></td>
      <td><?php echo $row_Recordset1['taeed']; ?></td>
      <td><?php echo $row_Recordset1['engheza']; ?></td>
      <td><?php echo $row_Recordset1['goshi']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center" bgcolor="666666"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

