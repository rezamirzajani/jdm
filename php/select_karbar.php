<?php
if (!isset($_SESSION)) {
  session_start();
} 
if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;}
require_once('../Connections/taradod.php'); 
if(isset($_POST['karbar'])){
$_SESSION['karbar'] = $_POST['karbar'];
header("location: rizkarkard_mah.php");
}
 mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_karbar = "SELECT * FROM karmand";
$karbar = mysql_query($query_karbar, $taradod) or die(mysql_error());
$row_karbar = mysql_fetch_assoc($karbar);
$totalRows_karbar = mysql_num_rows($karbar);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>انتخاب کاربر</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body><form action="select_karbar.php" method="post" enctype="multipart/form-data" name="fk">

  <div align="center">
    <p>&nbsp;    </p>
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="Submit" value="ارسال" />
      <select name="karbar">
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
</body>
</html>
<?php
mysql_free_result($karbar);
?>
