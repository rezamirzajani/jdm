<?php
 if(!isset($_COOKIE['taradode_company'])){header("location: sabt_taradod.php"); exit;} 
if (!isset($_SESSION)) {
  session_start();
}

include_once('../arabdate/arabic.php');
include_once('jdf.php');

$br = new Arabic('ArDate');
if(($_SESSION['sal1']%33)==1 || ($_SESSION['sal1']%33)==5 ||($_SESSION['sal1']%33)==9 ||($_SESSION['sal1']%33)==13 ||($_SESSION['sal1']%33)==18 ||($_SESSION['sal1']%33)==22 ||($_SESSION['sal1']%33)==26 ||($_SESSION['sal1']%33)==30 ){$_SESSION['kabise'] =1;}else{$_SESSION['kabise'] =0;}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تقویم رو میزی</title>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../js/js.js"></script>
<style type="text/css">
<!--
.style5 {font-size: 13px; }
.style6 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.style7 {color: #FFFFFF}
.style8 {font-size: 13px; color: #FFFFFF; }
-->
</style>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<?php 
$c = $_GET['c'];
$tarikh_roz= jdate('Y-m-d');
if(!isset($_SESSION['sal1'])){  $_SESSION['sal1'] =  $_SESSION['sal'];}
$sal = $_SESSION['sal1'];
$mah = $_GET['m'];
?>
<div align="center" class="font1">
<?php
$salem = jalali_to_gregorian($sal,$mah,'29','');

if($_GET['m']==1){ echo $_SESSION['sal1']." فروردین - march & april ".$salem[0];}
if($_GET['m']==2){ echo $_SESSION['sal1']." اردیبهشت - april & may ".$salem[0];}
if($_GET['m']==3){ echo $_SESSION['sal1']."خرداد - may & june ".$salem[0];}
if($_GET['m']==4){ echo $_SESSION['sal1']."تیر - june & july ".$salem[0];}
if($_GET['m']==5){ echo $_SESSION['sal1']."مرداد - july & august ".$salem[0];}
if($_GET['m']==6){ echo $_SESSION['sal1']."شهریور - august & september ".$salem[0];}
if($_GET['m']==7){ echo $_SESSION['sal1']."مهر - september & octobr ".$salem[0];}
if($_GET['m']==8){ echo $_SESSION['sal1']."آبان - octobr & november ".$salem[0];}
if($_GET['m']==9){ echo $_SESSION['sal1']."آذر - november & desember ".$salem[0];}
if($_GET['m']==10){ echo $_SESSION['sal1']."دی - december & january ".($salem[0]-1)." & ".$salem[0];}
if($_GET['m']==11){ echo $_SESSION['sal1']."بهمن - january & february ".$salem[0];} 
if($_GET['m']==12){ echo $_SESSION['sal1']."اسفند - february & march ".$salem[0];}

?>
</div>
<table width="806" height="689" border="0" align="center">
  <tr>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],1,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=1&n=<?php echo $_GET['n'];?>">1</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'1',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center"> <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95"  bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],2,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&amp;r=1&amp;n=<?php echo $_GET['n'];?>">2</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'2',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center"> <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95"  bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],3,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=3&n=<?php echo $_GET['n'];?>">3</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
<?php $miladi =  jalali_to_gregorian($sal,$mah,'3',''); echo $miladi[1]."/".$miladi[2];?>          
-<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95"  bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],4,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=4&n=<?php echo $_GET['n'];?>">4</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'4',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95"  bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],5,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=5&n=<?php echo $_GET['n'];?>">5</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'5',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95"  bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],6,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=6&n=<?php echo $_GET['n'];?>">6</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'6',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],7,$_SESSION['sal1']));
		
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=7&n=<?php echo $_GET['n'];?>">7</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'7',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],8,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=8&n=<?php echo $_GET['n'];?>">8</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'8',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],9,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=9&n=<?php echo $_GET['n'];?>">9</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'9',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],10,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=10&n=<?php echo $_GET['n'];?>">10</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'10',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],11,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=11&n=<?php echo $_GET['n'];?>">11</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'11',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],12,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=12&n=<?php echo $_GET['n'];?>">12</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'12',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],13,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=13&n=<?php echo $_GET['n'];?>">13</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'13',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],14,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=14&n=<?php echo $_GET['n'];?>">14</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'14',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],15,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=15&n=<?php echo $_GET['n'];?>">15</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'15',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],16,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=16&n=<?php echo $_GET['n'];?>">16</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'16',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],17,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=17&n=<?php echo $_GET['n'];?>">17</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'17',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],18,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=18&n=<?php echo $_GET['n'];?>">18</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'18',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],19,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=19&n=<?php echo $_GET['n'];?>">19</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'19',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],20,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=20&n=<?php echo $_GET['n'];?>">20</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'20',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],21,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=21&n=<?php echo $_GET['n'];?>">21</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'21',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],22,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=22&n=<?php echo $_GET['n'];?>">22</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'22',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],23,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=23&n=<?php echo $_GET['n'];?>">23</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'23',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],24,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=24&n=<?php echo $_GET['n'];?>">24</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'24',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],25,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=25&n=<?php echo $_GET['n'];?>">25</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'25',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],26,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=26&n=<?php echo $_GET['n'];?>">26</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'26',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],27,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=27&n=<?php echo $_GET['n'];?>">27</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'27',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],28,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=28&n=<?php echo $_GET['n'];?>">28</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'28',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],29,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=29&n=<?php echo $_GET['n'];?>">29</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'29',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <?php if($_SESSION['kabise'] == 0 && isset($_GET['esfand'])){?>
    <td width="95" height="95"><div align="center"><span class="style5"></span></div></td>
    <?php }else{ ?>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],30,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=30&n=<?php echo $_GET['n'];?>">30</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'30',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <?php } ?>
  </tr>
  <tr>
    <?php if(isset($_GET['esfand']) || isset($_GET['n2'])){?>
    <td width="95" height="95"><div align="center" class="style5">&nbsp;</div></td>
    <?php }else{?>
    <td width="95" height="95" bgcolor="#CADDFB"><table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1">
      <tr>
        <td class="style5"><div align="center">
          <?
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],31,$_SESSION['sal']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="style5"><div align="center" class="style7"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&r=31&n=<?php echo $_GET['n'];?>">31</a></div></td>
      </tr>
      <tr>
        <td bgcolor="#0099FF" class="style5 style6"><div align="center">
          <?php $miladi =  jalali_to_gregorian($sal,$mah,'31',''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));	 ?></div>
              <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#0033FF" class="style8"><div align="center">
          <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?>
        </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table></td>
    <?php }?>
    <td width="95" height="95"><div align="center"><span class="style5"></span></div></td>
    <td width="95" height="95"><div align="center"><span class="style5"></span></div></td>
    <td width="95" height="95"><div align="center"><span class="style5"></span></div></td>
    <td width="95" height="95"><div align="center"><span class="style5"></span></div></td>
    <td width="95" height="95"><div align="center">
      <table border="0" cellpadding="5" cellspacing="0" bgcolor="#CADDFB">
        <tr>
          <td><a href="list_yaddashtha.php?mm=<?php if($_GET['m']<10){echo "0".$_GET['m'];}else{echo $_GET['m'];}?>&n=<?php echo $_GET['n'];?>" target="_blank">لیست یادداشت ها </a></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
<br/>
<div align="center">
  <input name="Submit" type="submit" onclick="MM_goToURL('parent','taghvim.php?n=<?php echo $_GET['n'];?>');return document.MM_returnValue" value="بازگشت" />
</div>
</body>
</html>
