<?php

if (!isset($_SESSION)) {
  session_start();
}
if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;}
include_once("jdf.php"); 
include_once('../arabdate/arabic.php');

if (isset($_GET['sal'])) {
 $_SESSION['sal1'] = (get_magic_quotes_gpc()) ? $_GET['sal'] : addslashes($_GET['sal']);
}

if(!isset($_SESSION['sal1'])){  $_SESSION['sal1'] = jdate('Y');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ریز کارکرد</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
</head>

<body>

<table width="368" height="850" border="0" align="center" dir="rtl" class="yekan4">
  <tr>
    <td width="362" bgcolor="#CCCCCC"><div align="center"><span class="style1">سال: </span>
          <select name="menu1" onchange="MM_jumpMenu('parent',this,1)">
            <option value="rizkarkard_mah.php?sal=1391&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1391" ){ echo "selected=\"selected\"";} ?>>1391</option>
            <option value="rizkarkard_mah.php?sal=1392&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1392" ){ echo "selected=\"selected\"";} ?>>1392</option>
            <option value="rizkarkard_mah.php?sal=1393&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1393" ){ echo "selected=\"selected\"";} ?>>1393</option>
            <option value="rizkarkard_mah.php?sal=1394&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1394" ){ echo "selected=\"selected\"";} ?>>1394</option>
            <option value="rizkarkard_mah.php?sal=1395&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1395" ){ echo "selected=\"selected\"";} ?>>1395</option>
            <option value="rizkarkard_mah.php?sal=1396&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1396" ){ echo "selected=\"selected\"";} ?>>1396</option>
            <option value="rizkarkard_mah.php?sal=1397&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1397" ){ echo "selected=\"selected\"";} ?>>1397</option>
			<option value="rizkarkard_mah.php?sal=1398&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1398" ){ echo "selected=\"selected\"";} ?>>1398</option>
			<option value="rizkarkard_mah.php?sal=1399&amp;n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1399" ){ echo "selected=\"selected\"";} ?>>1399</option>
          </select>
    </div></td>
  </tr>
  <tr>
    <td width="362" bgcolor="#CCCCCC"><div align="center" ><a href="rizkarkard_roz1.php?m=1&amp;c=0&amp;n=<?php echo $_GET['n'];?>" class="style1">فرورین</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" >march &amp; april</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td width="362" bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=2&amp;c=31&amp;n=<?php echo $_GET['n'];?>">اردیبهشت</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">april &amp; may</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td width="362" bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=3&amp;c=62&amp;n=<?php echo $_GET['n'];?>">خرداد</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">may &amp; june</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=4&amp;c=93&amp;n=<?php echo $_GET['n'];?>">تیر</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">june &amp; july</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=5&amp;c=124&amp;n=<?php echo $_GET['n'];?>">مرداد</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">july &amp; august</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=6&amp;n=<?php echo $_GET['n'];?>">شهریور</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">august &amp; september</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=7&amp;c=186&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">مهر</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">september &amp; octobr</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=8&amp;c=216&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">آبان</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">octobr &amp; november</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=9&amp;c=246&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">آذر</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">november &amp; desember</div></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=10&amp;c=276&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">دی</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">december &amp; january</div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=11&amp;c=306&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">بهمن</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">january &amp; february</div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center" class="style1"><a href="rizkarkard_roz1.php?m=12&amp;c=336&amp;esfand=1&amp;n=<?php echo $_GET['n'];?>">اسفند</a></div>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center" class="style2">february &amp; march</div></td>
          </tr>
    </table></td>
  </tr>
</table>
<br/>
<div align="center">
  <input name="Submit" class="back" type="submit" onclick="MM_goToURL('parent','info.php');return document.MM_returnValue" value="بازگشت" />
</div>

</body>
</html>
