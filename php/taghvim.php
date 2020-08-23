<?php
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['/accals/php/taghvim_roz.php'] = 0; 

if (!isset($_SESSION)) {
  session_start();
}
include_once("jdf.php"); 
if ( isset($_GET['sal'])) {
 $_SESSION['sal1'] = (get_magic_quotes_gpc()) ? $_GET['sal'] : addslashes($_GET['sal']);
  
}

include_once('../arabdate/arabic.php');
if(!isset($_SESSION['sal1'])){  $_SESSION['sal1'] =  $_SESSION['sal'];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تقویم</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}


function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 12px}
.style4 {font-size: 18px}
-->
</style>
</head>

<body>


<table width="600" height="500" border="0" align="center" dir="rtl">
  <tr>
    <td width="125" bgcolor="#CADDFB"><div align="center"><span class="style1">سال: 
        </span>
      <select name="menu1" onchange="MM_jumpMenu('parent',this,1)">
        <option value="taghvim.php?sal=1391&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1391" ){ echo "selected=\"selected\"";} ?>>1391</option>
        <option value="taghvim.php?sal=1392&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1392" ){ echo "selected=\"selected\"";} ?>>1392</option>
        <option value="taghvim.php?sal=1393&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1393" ){ echo "selected=\"selected\"";} ?>>1393</option>
        <option value="taghvim.php?sal=1394&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1394" ){ echo "selected=\"selected\"";} ?>>1394</option>
	    <option value="taghvim.php?sal=1395&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1395" ){ echo "selected=\"selected\"";} ?>>1395</option>
		<option value="taghvim.php?sal=1396&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1396" ){ echo "selected=\"selected\"";} ?>>1396</option>        <option value="taghvim.php?sal=1397&n=<?php echo $_GET['n'];?>"<?php if($_SESSION['sal1'] == "1397" ){ echo "selected=\"selected\"";} ?>>1397</option>
        </select>
    </div></td>
    <td width="125" bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=1&amp;c=0&amp;n=<?php echo $_GET['n'];?>">فرورین</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">march &amp; april</div></td>
        </tr>
      </table></td>
    <td width="125" bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=2&amp;c=31&amp;n=<?php echo $_GET['n'];?>">اردیبهشت</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">april &amp; may</div></td>
        </tr>
      </table></td>
    <td width="125" bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=3&amp;c=62&amp;n=<?php echo $_GET['n'];?>">خرداد</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">may &amp; june</div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="list_yaddashtha.php?n=<?php echo $_GET['n'];?>" target="_blank" class="style4">لیست یادداشتها </a></div></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=4&amp;c=93&amp;n=<?php echo $_GET['n'];?>">تیر</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">june &amp; july</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=5&amp;c=124&amp;n=<?php echo $_GET['n'];?>">مرداد</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">july &amp; august</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=6&n=<?php echo $_GET['n'];?>">شهریور</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">august &amp; september</div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=7&amp;c=186&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">مهر</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">september &amp; octobr</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=8&amp;c=216&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">آبان</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">octobr &amp; november</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=9&amp;c=246&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">آذر</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">november &amp; desember</div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=10&amp;c=276&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">دی</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">december &amp; january</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=11&amp;c=306&amp;n2=1&amp;n=<?php echo $_GET['n'];?>">بهمن</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">january &amp; february</div></td>
        </tr>
      </table></td>
    <td bgcolor="#CADDFB"><div align="center" class="style1"><a href="taghvim_roz.php?m=12&amp;c=336&amp;esfand=1&amp;n=<?php echo $_GET['n'];?>">اسفند</a></div>
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style2">february &amp; march</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<br/>
<div align="center">
  <input name="Submit" type="submit" onclick="MM_goToURL('parent','taghvim_day.php?n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value="بازگشت" />
</div>

</body>
</html>
