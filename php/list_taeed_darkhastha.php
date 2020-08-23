<?php
if (!isset($_SESSION)) {
  session_start();
}
 if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;} 
 require_once('../Connections/taradod.php');
if(isset($_POST['karbar'])){
$_SESSION['karbar'] = $_POST['karbar'];
} 
if(isset($_SESSION['karbar']) && $_SESSION['karbar'] == "all"){
$k="";
} 
if(isset($_SESSION['karbar']) && $_SESSION['karbar'] != "all"){
$k = "where karmand.mac = '".$_SESSION['karbar']."'";
}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_karbar = "SELECT * FROM karmand";
$karbar = mysql_query($query_karbar, $taradod) or die(mysql_error());
$row_karbar = mysql_fetch_assoc($karbar);
$totalRows_karbar = mysql_num_rows($karbar);
 
 
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_list_darkhastha = 20;
$pageNum_list_darkhastha = 0;
if (isset($_GET['pageNum_list_darkhastha'])) {
  $pageNum_list_darkhastha = $_GET['pageNum_list_darkhastha'];
}
$startRow_list_darkhastha = $pageNum_list_darkhastha * $maxRows_list_darkhastha;

mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_list_darkhastha = "SELECT * FROM saat_khas inner join noe_darkhast on noe_darkhast = idn inner join karmand on saat_khas.idk = karmand.idk $k ORDER BY id DESC";
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


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>لیست درخواستها</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>
<form action="list_taeed_darkhastha.php" method="post" enctype="multipart/form-data" name="fk">

  <div align="center">
    <p>&nbsp;    </p>
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="Submit" value="ارسال" />
      <select name="karbar">
	  <option value="all">همه</option>
        <?php
do {  
?>
        <option value="<?php echo $row_karbar['mac']?>" <?php if($_SESSION['karbar'] == $row_karbar['mac']){ ?>selected="selected" <?php } ?>><?php echo $row_karbar['name']." ".$row_karbar['famili']?></option>
        <?php
} while ($row_karbar = mysql_fetch_assoc($karbar));
  $rows = mysql_num_rows($karbar);
  if($rows > 0) {
      mysql_data_seek($karbar, 0);
	  $row_karbar = mysql_fetch_assoc($karbar);
  }
?>
        </select>
      </p>
  </div>
</form>
<table border="0" align="center" cellpadding="1" cellspacing="1" dir="rtl">
  <tr bgcolor="#CC33CC" class="yekan5">
    <td><div align="center" >کد</div></td>
	<td><div align="center" >درخواست کننده</div></td>
    <td><div align="center" >درخواست</div></td>
    <td><div align="center" >تاریخ ثبت</div></td>
    <td><div align="center" >زمان ثبت</div></td>
    <td><div align="center" >تاریخ </div></td>
    <td><div align="center" >ساعت</div></td>
    <td><div align="center" >مدت</div></td>
    <td><div align="center" >توضیحات</div></td>
    <td><div align="center" >تایید</div></td>
  </tr>
  <?php do { ?>
    <tr bgcolor="#CCCCCC" class="yekan6">
      <td><a href="taeed_darkhastha.php?id=<?php echo $row_list_darkhastha['id']; ?>"><?php echo $row_list_darkhastha['id']; ?></a></td>
	  <td><?php echo $row_list_darkhastha['name']." ".$row_list_darkhastha['famili']; ?></td>
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
  <input type="button" class="back" name="Button" value="بازگشت" onclick="MM_goToURL('parent','admin.php');return document.MM_returnValue" />
</p>
</body>
</html>
<?php
mysql_free_result($list_darkhastha);
?>
