<?php require_once('../Connections/taradod.php'); ?>
<?php
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


if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;}

$colname_darkhast = "-1";
if (isset($_GET['id'])) {
  $colname_darkhast = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_darkhast = sprintf("SELECT * FROM saat_khas inner join noe_darkhast on noe_darkhast = idn inner join karmand on saat_khas.idk = karmand.idk WHERE saat_khas.id = %s", $colname_darkhast);
$darkhast = mysql_query($query_darkhast, $taradod) or die(mysql_error());
$row_darkhast = mysql_fetch_assoc($darkhast);
$totalRows_darkhast = mysql_num_rows($darkhast);
 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_taeed") && $_POST['vaziyat_darkhast']!=0) {

  $updateSQL = sprintf("UPDATE saat_khas SET taeed=%s WHERE id=%s",
                       GetSQLValueString($_POST['vaziyat_darkhast'], "int"),
                       GetSQLValueString($_POST['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
////////////////////////////////////////////////////////////////////////////// 
  if(($row_darkhast['noe_darkhast'] == 1 || $row_darkhast['noe_darkhast'] == 2 || $row_darkhast['noe_darkhast'] == 11 || $row_darkhast['noe_darkhast'] == 12) && $row_darkhast['engheza'] == 1 /*&& $_POST['vaziyat_darkhast'] == 2*/){
  
  if($row_darkhast['noe_darkhast'] == 1 || $row_darkhast['noe_darkhast'] == 11){$noe_t=1;}
  if($row_darkhast['noe_darkhast'] == 2 || $row_darkhast['noe_darkhast'] == 12){$noe_t=2;}
   /* $insertSQL = sprintf("INSERT INTO saat (idk, tarikh, saat, noe, noe_taradod, id_darkhast) VALUES (%s, %s, %s, 0, %s, %s)",
                       GetSQLValueString($row_darkhast['idk'], "int"),
                       GetSQLValueString($row_darkhast['tarikh_darkhast'], "text"),
                       GetSQLValueString($row_darkhast['zaman_darkhast'], "text"),
					   GetSQLValueString($noe_t, "int"),
					   GetSQLValueString($row_darkhast['id'], "text"));
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($insertSQL, $taradod) or die(mysql_error());*/
   $updateSQL = sprintf("UPDATE saat SET  taeed=%s WHERE tarikh=%s and saat=%s",
  					   GetSQLValueString($_POST['vaziyat_darkhast'], "int"),
                       GetSQLValueString($row_darkhast['tarikh_darkhast'], "text"),
					   GetSQLValueString($row_darkhast['zaman_darkhast'], "text"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
  
  $updateSQL = sprintf("UPDATE saat_khas SET engheza=2 WHERE id=%s",
                       GetSQLValueString($row_darkhast['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
  
  }
  
  if(($row_darkhast['noe_darkhast'] == 1 || $row_darkhast['noe_darkhast'] == 2 || $row_darkhast['noe_darkhast'] == 11 || $row_darkhast['noe_darkhast'] == 12) && $row_darkhast['engheza'] == 2 /*&& $_POST['vaziyat_darkhast'] == 3*/){
  /*$deleteSQL = sprintf("DELETE FROM saat WHERE id_darkhast=%s",
                       GetSQLValueString($row_darkhast['id'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($deleteSQL, $taradod) or die(mysql_error());*/
     $updateSQL = sprintf("UPDATE saat SET taeed=%s WHERE id_darkhast=%s",
	 				   GetSQLValueString($_POST['vaziyat_darkhast'], "int"),
                       GetSQLValueString($row_darkhast['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
  
   $updateSQL = sprintf("UPDATE saat_khas SET engheza=1 WHERE id=%s",
                       GetSQLValueString($row_darkhast['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
}
if($row_darkhast['noe_darkhast'] == 101 && $row_darkhast['engheza'] == 1 && $_POST['vaziyat_darkhast'] == 2){
  $deleteSQL = sprintf("DELETE FROM saat WHERE idt=%s",
                       GetSQLValueString($_POST['record'], "int"));

  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($deleteSQL, $taradod) or die(mysql_error());
  
   $updateSQL = sprintf("UPDATE saat_khas SET engheza=2 WHERE id=%s",
                       GetSQLValueString($row_darkhast['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
}
if($row_darkhast['noe_darkhast'] == 100 && $row_darkhast['engheza'] == 1 && $_POST['vaziyat_darkhast'] == 2){
    $updateSQL = sprintf("UPDATE saat SET tarikh=%s, saat=%s, id_darkhast=%s WHERE idt=%s",
	                   GetSQLValueString($row_darkhast['tarikh_darkhast'], "text"),
					   GetSQLValueString($row_darkhast['zaman_darkhast'], "text"),
					   GetSQLValueString($_POST['id'], "text"),
                       GetSQLValueString($row_darkhast['modat'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error()); 
  
   $updateSQL = sprintf("UPDATE saat_khas SET engheza=2 WHERE id=%s",
                       GetSQLValueString($row_darkhast['id'], "int"));
  mysql_query('set names "utf8"', $taradod);
  mysql_select_db($database_taradod, $taradod);
  $Result1 = mysql_query($updateSQL, $taradod) or die(mysql_error());
}
  header("location: list_taeed_darkhastha.php");
}
 

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تایید درخواست</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>
<body>

<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_taeed">
<table width="698" border="0" align="center" cellpadding="1" cellspacing="1" dir="rtl" class="yekan3">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#CC00FF">
    <td colspan="2"><div align="center" class="yekan4"> زمان ثبت <?php echo $row_darkhast['zaman_sabt']; ?> - <?php echo $row_darkhast['tarikh_sabt']; ?></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">اینجانب <?php echo $row_darkhast['name']." ".$row_darkhast['famili']; ?> درخواست <?php echo $row_darkhast['onvan']; if($row_darkhast['noe_darkhast'] == 100 || $row_darkhast['noe_darkhast'] == 101){ echo $row_darkhast['modat'];?><input name="record" type="hidden" value="<?php echo $row_darkhast['modat']; ?>" /> <?php 
	
mysql_select_db($database_taradod, $taradod);
$query_saat_old = "SELECT * FROM saat WHERE idt = ".$row_darkhast['modat'];
$saat_old = mysql_query($query_saat_old, $taradod) or die(mysql_error());
$row_saat_old = mysql_fetch_assoc($saat_old);
$totalRows_saat_old = mysql_num_rows($saat_old);
echo "(".$row_saat_old['saat'].")";	
	
	}?></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">  <?php if($row_darkhast['noe_darkhast'] == 3 || $row_darkhast['noe_darkhast'] == 4 || $row_darkhast['noe_darkhast'] == 5 || $row_darkhast['noe_darkhast'] == 6 || $row_darkhast['noe_darkhast'] == 8 || $row_darkhast['noe_darkhast'] == 9){echo "از"; }elseif($row_darkhast['noe_darkhast'] == 100 ){echo "به";}else{echo "در";}?> تاریخ <?php echo $row_darkhast['tarikh_darkhast']; ?> ساعت <?php echo $row_darkhast['zaman_darkhast']; ?></div></td>
  </tr>
  <?php if($row_darkhast['noe_darkhast'] == 3 || $row_darkhast['noe_darkhast'] == 4 || $row_darkhast['noe_darkhast'] == 5 || $row_darkhast['noe_darkhast'] == 6 || $row_darkhast['noe_darkhast'] == 8 || $row_darkhast['noe_darkhast'] == 9){ ?>
  <tr>
    <td colspan="2"><div align="center">به مدت <?php echo $row_darkhast['modat']; 
	if($row_darkhast['noe_darkhast'] == 3 || $row_darkhast['noe_darkhast'] == 5 || $row_darkhast['noe_darkhast'] == 8 || $row_darkhast['noe_darkhast'] == 9){echo "ساعت";}
	if($row_darkhast['noe_darkhast'] == 4 || $row_darkhast['noe_darkhast'] == 6 ){echo "روز";}	
	
	?></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2"><div align="center">به علت <?php echo $row_darkhast['tozihat']; ?> را دارم </div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php if(($row_darkhast['noe_darkhast'] != 100 && $row_darkhast['noe_darkhast'] != 101) || $row_darkhast['engheza'] != 2) {?>
  <tr>
    <td width="127">وضعیت : </td>
    <td width="564"><select name="vaziyat_darkhast">
	 <option ></option>
      <option value="2">تایید</option>
      <option value="3">عدم تایید</option>
    </select>    </td>
  </tr>  
  <?php } ?>
 <!-- <tr>
    <td>توضیحات: </td>
    <td>
          <input name="tozihat" type="text" style="width:400px" />
         </td>
  </tr>-->
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit2" value="تایید" />
      <input type="submit" name="Submit3" value="بازگشت" onclick="MM_goToURL('parent','list_taeed_darkhastha.php');return document.MM_returnValue" />
    </div></td>
  </tr>
</table>
<input type="hidden" name="MM_update" value="form_taeed"> <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
</form>
</body>
</html>

