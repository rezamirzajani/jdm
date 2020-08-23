<?php if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>اطلاعات فردی</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style3 {font-size: 24px; }
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="375" border="0" align="center" cellpadding="0" cellspacing="5" class="yekan3">
  <tr>
    <td width="365"><div align="center" class="yekan2">اطلاعات فردی </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td background="list_saat.php" bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"><a href="list_saat.php">مشاهده ساعت های ثبت شده </a>    </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"><a href="list_darkhastha.php">مشاهده درخواست ها</a>    </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3"><div align="center" class="style1">مشاهده فیش حقوقی </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1">مشاهده مشخصات </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1">تغییر پسورد </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" class="style3">
    <div align="center" class="style1"><a href="rizkarkard_mah.php">ریز کارکرد </a></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1 style3"><a href="taghvim_day.php">تقویم</a></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="button" class="back" name="Button" value="بازگشت" onclick="MM_goToURL('parent','sabt_taradod.php');return document.MM_returnValue" />
    </div></td>
  </tr>
</table>
</body>

</html>
