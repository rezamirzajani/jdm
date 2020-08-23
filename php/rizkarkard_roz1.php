<?php

if (!isset($_SESSION)) {
  session_start();
}
if(!isset($_COOKIE['taradode_company']) && !isset($_SESSION['melli'])){header("location: sabt_taradod.php"); exit;}
require_once('../Connections/taradod.php');
include_once('../arabdate/arabic.php');
include_once('jdf.php');
//////////
$c = $_GET['c'];
$tarikh_roz= jdate('Y-m-d');
if(!isset($_SESSION['sal1'])){  $_SESSION['sal1'] =  jdate('Y');}
$sal = $_SESSION['sal1'];
$mah = $_GET['m'];
if($_GET['m']<10){$m = "0".$_GET['m'];}else{$m = $_GET['m'];}
$tt = $sal."-".$m."-01";

////////////

$br = new arabic('ArDate');

if(($_SESSION['sal1']%33)==1 || ($_SESSION['sal1']%33)==5 ||($_SESSION['sal1']%33)==9 ||($_SESSION['sal1']%33)==13 ||($_SESSION['sal1']%33)==18 ||($_SESSION['sal1']%33)==22 ||($_SESSION['sal1']%33)==26 ||($_SESSION['sal1']%33)==30 ){$_SESSION['kabise'] =1;}else{$_SESSION['kabise'] =0;}
///////////

$colname_select_karmand = "-1";
if (isset($_COOKIE['taradode_company']) && !isset($_SESSION['karbar'])) {
  $colname_select_karmand = (get_magic_quotes_gpc()) ? $_COOKIE['taradode_company'] : addslashes($_COOKIE['taradode_company']);
}
if (isset($_SESSION['karbar'])) {

  $colname_select_karmand = (get_magic_quotes_gpc()) ? $_SESSION['karbar'] : addslashes($_SESSION['karbar']);
}

mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_select_karmand = sprintf("SELECT * FROM karmand inner join vaset_karman_dastmozd on karmand.idk = vaset_karman_dastmozd.idvk inner join dastmozd on vaset_karman_dastmozd.idvd = dastmozd.idd WHERE mac = '%s' and tarikh_shoroe_etebar <= '$tt' and tarikh_payan_etebar >= '$tt' ORDER BY idvki DESC ", $colname_select_karmand);
$select_karmand = mysql_query($query_select_karmand, $taradod) or die("error");
$row_select_karmand = mysql_fetch_assoc($select_karmand);
$totalRows_select_karmand = mysql_num_rows($select_karmand);
$idk = $row_select_karmand['idk'];
/*echo $query_select_karmand ;
exit;*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ریز کارکرد</title>
<link href="../css/css1.css" rel="stylesheet" type="text/css" />
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
</head>

<body>

<?php if($idk == "" ){ ?>
<div class="yekan3" align="center">دستمزد برای این ماه تعریف نشده</div>
<?php exit;} ?>
<div align="center" class="yekan6"><?php echo  $row_select_karmand['name']." ".$row_select_karmand['famili']; ?></div>
<div align="left">
  <input name="Submit" class="back" type="submit" onclick="MM_goToURL('parent','rizkarkard_mah.php');return document.MM_returnValue" value="بازگشت" />
</div>
<?php  ?>
<div align="center" class="yekan3">
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
<br/>
<table  border="0" align="center" cellpadding="1" cellspacing="1" dir="rtl">
<tr align="center" bgcolor="#EFE2EE" class="yekan6"> 
<td>تاریخ</td>
<td>زمانهای ثبت شده</td>
<td>درخواستها</td>
<td nowrap="nowrap">مجموع کارکرد در روز</td>
<td nowrap="nowrap">مجموع درخواستها</td>
</tr>
<?php 
if($_GET['m']<=6){$conter = 31;}elseif($_SESSION['kabise'] == 0 && isset($_GET['esfand'])){$conter = 29;}else{$conter = 30;}
$total_kol_karkard = 0;
$mamoriat_saati_kol = 0;
$morakhasi_saati_kol = 0;
$ezafekari_saati_kol = 0;
 for($i=1;$i<=$conter;$i++){ ?>
  <tr bgcolor="#EFE2EE" class="yekan7">
    <td width="192">
	<table width="90%" height="80%"  border="0" align="center" cellpadding="0" cellspacing="1" class="yekan7">
      <tr>
        <td bgcolor="#CC00FF" class="style5"><div align="center">
            <?php
		echo  jdate('l',jmktime(0,0,0,$_GET['m'],$i,$_SESSION['sal1']));
		 ?>
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#CCCCCC" class="style5"><div align="center" class="style1"><a href="taghvim_not.php?m=<?php echo $_GET['m'];?>&amp;r=<?php echo $i; ?>&amp;n=<?php echo $_GET['n'];?>"><?php echo $i; ?></a></div></td>
      </tr>
      <tr>
        <td bgcolor="#CC66FF" class="style5 style6"><div align="center">
            <?php $miladi =  jalali_to_gregorian($sal,$mah,$i,''); echo $miladi[1]."/".$miladi[2];?>
          -<?php echo date('M',mktime(0,0,0,$miladi[1],($miladi[2]),$miladi[0]));?></div>
            <div align="center"></div></td>
      </tr>
      <tr>
        <td bgcolor="#CC99FF" class="style8"><div align="center"> <?php echo $br->date('m/d - M',mktime(0,0,0,$miladi[1],$miladi[2]-1,$miladi[0]));		
		?> </div></td>
      </tr>
      <tr>
        <td height="3" class="style5"></td>
      </tr>
    </table>	</td>
    <td><?php
$v = 1; 
if($_GET['m']<10){$m = "0".$_GET['m'];}else{$m = $_GET['m'];}
if($i<10){$i = "0".$i;}  
$t = $_SESSION['sal1']."-".$m."-".$i;
mysql_select_db($database_taradod, $taradod);
$query_saat = "SELECT * FROM saat WHERE idk = $idk and tarikh = '$t' ORDER BY saat ASC";
$saat = mysql_query($query_saat, $taradod) or die(mysql_error());
$row_saat = mysql_fetch_assoc($saat);
$totalRows_saat = mysql_num_rows($saat);
	
	?>
      <table border="0" cellpadding="1" cellspacing="1" dir="rtl">
    <tr>
	<?php $total=0; $temp1=0; $temp2=0; $s=1; $ss=1; $c=0; do { ?>
      <td>
   <?php if($totalRows_saat != 0){ 
       
   ?>
	  <table border="0" cellspacing="1" cellpadding="1" class="yekan7">
        <tr>
		 <?php  if($row_saat['noe_taradod'] == $c && $c == 1){ ?>
          <td bgcolor="FF6600"><div align="center">ccخروج</div></td>
		<?php } ?>
		<?php  if($row_saat['noe_taradod'] == $c && $c == 2){ ?>
          <td bgcolor="#FF6600"><div align="center">ورود</div></td>
		<?php } ?>
		<?php  if($row_saat['noe_taradod'] == 2 && $ss == 1){ 
		

/////////////////////////////tarikh baraye moghayeshe{
$iii = ($i-1);
$mmm = $_GET['m'];
if($_SESSION['kabise'] == 0 && $_GET['m']<=6){
$sss =$_SESSION['sal1'];
if($iii < 1){$mmm = $mmm-1; $iii = 31;}
if($iii > 31){$mmm = $mmm+1; $iii = 1;}
if($mmm < 1){$s = $_SESSION['sal1']-1;
if(($sss%33)==1 || ($sss%33)==5 ||($sss%33)==9 ||($sss%33)==13 ||($sss%33)==18 ||($sss%33)==22 ||($sss%33)==26 ||($sss%33)==30 ){$mmm = 12; $iii = 29;}else{$mmm = 12; $iii = 30;}
 }
}
if($_SESSION['kabise'] == 0 && $_GET['m']>6){
$s =$_SESSION['sal1'];
if($iii < 1){$mmm = $mmm-1; if($mmm == 6){$ii = 31;}else{$iii = 30;}}
if($iii > 30){$mmm = $mmm+1; $i = 1;}
if($mmm > 12){$s = $_SESSION['sal1']+1; $mmm = 1; $iii = 1;}
}
if($mmm<10){$mmm = "0".$mmm;}
if($iii<10){$iii = "0".$iii;} 
$tttt = $sss."-".$mmm."-".$iii;	
//echo $tttt;
/////////////////////////////////////////////////////}
mysql_select_db($database_taradod, $taradod);
$query_saat3 = "SELECT * FROM saat WHERE idk = $idk and tarikh = '$tttt' ORDER BY saat desc";
$saat3 = mysql_query($query_saat3, $taradod) or die(mysql_error());
$row_saat3 = mysql_fetch_assoc($saat3);
$totalRows_saat3 = mysql_num_rows($saat3);
		?>
      <td bgcolor="<?php if($row_saat3['noe_taradod']==1){echo "#CC99FF";}else{echo "#FF6600";} ?>"><div align="center">ورود</div></td>
		<?php } ?>
          <td bgcolor="<?php if($row_saat['taeed'] == 0){echo "#CC99FF";} if($row_saat['taeed'] == 1){echo "#FFFF00";} if($row_saat['taeed'] == 2){echo "#00CC00";}  if($row_saat['taeed'] == 3){echo "#666666";}?>"><div align="center">
            <?php if($row_saat['noe_taradod'] == 1){echo "ورود";}else{echo "خروج";} ?>
		<?php  if($row_saat['noe_taradod']==1 && $s == $totalRows_saat){ 
		


/////////////////////////////tarikh baraye moghayeshe{
$ii = ($i+1);
$mm = $_GET['m'];
if($_SESSION['kabise'] == 0 && $_GET['m']<=6){
$ss =$_SESSION['sal1'];
if($ii < 1){$mm = $mm-1; $ii = 31;}
if($ii > 31){$mm = $mm+1; $ii = 1;}
if($mm < 1){$ss = $_SESSION['sal1']-1;
if(($ss%33)==1 || ($ss%33)==5 ||($ss%33)==9 ||($ss%33)==13 ||($ss%33)==18 ||($ss%33)==22 ||($ss%33)==26 ||($ss%33)==30 ){$mm = 12; $ii = 29;}else{$mm = 12; $ii = 30;}
 }
}
if($_SESSION['kabise'] == 0 && $_GET['m']>6){
$s =$_SESSION['sal1'];
if($ii < 1){$mm = $mm-1; if($mm == 6){$ii = 31;}else{$ii = 30;}}
if($ii > 30){$mm = $mm+1; $i = 1;}
if($mm > 12){$ss = $_SESSION['sal1']+1; $mm = 1; $ii = 1;}
}
if($mm<10){$mm = "0".$mm;}
if($ii<10){$ii = "0".$ii;} 
$ttt = $ss."-".$mm."-".$ii;
//echo $ttt;	
/////////////////////////////////////////////////////}
mysql_select_db($database_taradod, $taradod);
$query_saat2 = "SELECT * FROM saat WHERE idk = $idk and tarikh = '$ttt' ORDER BY saat desc";
$saat2 = mysql_query($query_saat2, $taradod) or die(mysql_error());
$row_saat2 = mysql_fetch_assoc($saat2);
$totalRows_saat2 = mysql_num_rows($saat2);
		
		?>
        <td bgcolor="<?php if($row_saat2['noe_taradod']){echo "#CC99FF";}else{echo "#FF6600";} ?>"><div align="center">خروج</div></td>
		<?php } ?>
          </div></td>
        </tr>
        <tr>
		<?php  if($row_saat['noe_taradod'] == $c && $c == 1){ ?>
          <td bgcolor="#CCCCFF"><div align="center"><a href="sabte_mavagh.php?t=<?php echo $t; ?>&n=2">?</a></div></td>
		<?php } ?>
				 <?php  if($row_saat['noe_taradod'] == $c && $c == 2){ ?>
          <td bgcolor="#CCCCFF"><div align="center"><a href="sabte_mavagh.php?t=<?php echo $t; ?>&n=1">?</a></div></td>
		<?php } ?>
				<?php  if($row_saat['noe_taradod'] == 2 && $ss == 1){ ?>
          <td bgcolor="#CCCCFF"><div align="center"><a href="sabte_mavagh.php?t=<?php echo $t; ?>&n=1">
		  <?php	
		
if($row_saat3['noe_taradod']==1){echo "<<";   $temp1 = jmktime(00 ,00 ,00 ,$_GET['m'],$i,$_SESSION['sal1']);}else{echo "?";}?>
		  
		  </a></div></td>
		<?php } ?>
          <td bgcolor="#CCCCFF"><div align="center"><a href="<?php if($row_saat['taeed']==1){echo "del_saat_moavagh.php";}else{echo "eslahe_saat.php";} ?>?i=<?php echo $row_saat['idt']; ?>"><?php 
		  echo $row_saat['saat']; 
		  $zaman = explode(":",$row_saat['saat']);
	
		   if($row_saat['noe_taradod'] == 1 && ($row_saat['taeed'] == 2 || $row_saat['taeed'] == 0)){ $temp1 = jmktime($zaman[0] ,$zaman[1] ,$zaman[2] ,$_GET['m'],$i,$_SESSION['sal1']); }
		   if($row_saat['noe_taradod'] == 2 && ($row_saat['taeed'] == 2 || $row_saat['taeed'] == 0)){$temp2 = jmktime($zaman[0] ,$zaman[1] ,$zaman[2] ,$_GET['m'],$i,$_SESSION['sal1']); } 
		  // echo "<br/>".$temp1."<br/>"; echo $temp2;
		  ?></a></div></td>
		  		<?php  if($row_saat['noe_taradod']==1 && $s == $totalRows_saat){ ?>
          <td bgcolor="#CCCCFF"><div align="center"><a href="sabte_mavagh.php?t=<?php echo $t; ?>&n=2">
<?php	
if($row_saat2['noe_taradod']){echo ">>"; $temp2 = jmktime(00 ,00 ,00 ,$mm,$ii,$ss); }else{echo "?";}
?>	  
</a></div></td>
		<?php } ?>
        </tr>
      </table>
	  <?php  //echo "<br/>".$temp1."<br/>"; echo $temp2; 
	  /////////////shart dorst bodan saathaye sabt shode va mohasebe tafazol anha
	/*  if((($s%2) == 0 || $s == $totalRows_saat || $ss == 1) &&
	   $temp1 != 0 &&
	    $temp2 != 0 &&
		($row_saat['noe_taradod'] != $c && ($c != 1 ||  $c != 2 ||  $ss != 1))){*/
		if($temp2-$temp1>0 &&  $temp1>0 && $temp2>0){
		$total=$total+($temp2-$temp1); /*echo $temp1."<br>"; echo $temp2;*/ $temp1=0; $temp2=0;/*}*/} }?>
	  </td>
    <?php $c = $row_saat['noe_taradod']; $s++; $ss=0;} while ($row_saat = mysql_fetch_assoc($saat)); ?>
    </tr>
</table>
</td>
<td>
<?php
if($_GET['m']<10){$m = "0".$_GET['m'];}else{$m = $_GET['m'];}
//if($i<10){$i = "0".$i;}  
$ta = $_SESSION['sal1']."-".$m."-".$i;
//echo $ta;
mysql_select_db($database_taradod, $taradod);
$query_saat_khas = "SELECT * FROM list_riz_darkhast inner join noe_darkhast on l_noe_darkhast = idn inner join saat_khas on id = idd WHERE list_riz_darkhast.idk = $idk and l_noe_darkhast in(3,4,5,6,8,9,100,101) and l_tarikhdarkhast = '$ta' ORDER BY l_zamandarkhast ASC";
$saat_khas = mysql_query($query_saat_khas, $taradod) or die(mysql_error());
$row_saat_khas = mysql_fetch_assoc($saat_khas);
$totalRows_saat_khas = mysql_num_rows($saat_khas);

?>
<table border="0" cellpadding="1" cellspacing="1" dir="rtl">
<tr>
	<?php
	$totalkol_ezafekari_saati = 0; 
	$totalkol_morkhasi_saati = 0;
	$totalkol_mamorit_saati = 0;
	 do { ?>
<td>
   <?php if($totalRows_saat_khas != 0){ ?>
   	  <table border="0" cellspacing="1" cellpadding="1" class="yekan7">
    <tr>
	<td bgcolor="<?php if($row_saat_khas['taeed'] == 1){echo "#FFFF00";}elseif($row_saat_khas['taeed'] == 3){echo "#666666";}else{echo "#CC99FF";}?>">
 <div align="center"><?php echo $row_saat_khas['onvan']; ?></div> </td>
        </tr>
        <tr>
          <td bgcolor="<?php if($row_saat_khas['taeed'] == 1){echo "#CCCCFF";}else{echo "#CCCCFF";}?>"><div align="center"><a href="del_darkhast.php?i=<?php echo $row_saat_khas['id']; ?>"><?php echo $row_saat_khas['l_modat']; ?></a></div>		  </td>
		 </tr>
      </table>
	  <?php
	 if(($row_saat_khas['l_noe_darkhast'] == 5 || $row_saat_khas['l_noe_darkhast'] == 9 || $row_saat_khas['l_noe_darkhast'] == 6) && $row_saat_khas['taeed'] == 2){
/*	 if($row_saat_khas['l_noe_darkhast'] == 6){
	 $totalkol_mamorit_saati = $row_saat_khas['l_modat']*8*60*60;
	 }else{*/
     $total_mamorit_saati = explode(':',$row_saat_khas['l_modat']);  
	 $total_mamorit_saati['1'] = $total_mamorit_saati['1']*60;
	 $total_mamorit_saati['0'] = $total_mamorit_saati['0']*60*60;
	 $totalkol_mamorit_saati = $totalkol_mamorit_saati + $total_mamorit_saati['1'] + $total_mamorit_saati['0'];//}
	  }
	 if(($row_saat_khas['l_noe_darkhast'] == 3 || $row_saat_khas['l_noe_darkhast'] == 4) && $row_saat_khas['taeed'] == 2){
   /*if($row_saat_khas['l_noe_darkhast'] == 4 && $row_saat_khas['l_modat'] == 1){
	 $totalkol_morkhasi_saati = $row_saat_khas['l_modat']*8*60*60;
	 $row_saat_khas['l_modat'] = 8;
	 }else{*/
     $total_morkhasi_saati = explode(':',$row_saat_khas['l_modat']);  
	 $total_morkhasi_saati['1'] = $total_morkhasi_saati['1']*60;
	 $total_morkhasi_saati['0'] = $total_morkhasi_saati['0']*60*60;
	 $totalkol_morkhasi_saati = $totalkol_morkhasi_saati + $total_morkhasi_saati['1'] + $total_morkhasi_saati['0'];//}
	  }
	 if($row_saat_khas['l_noe_darkhast'] == 8 && $row_saat_khas['taeed'] == 2){
     $total_ezafekari_saati = explode(':',$row_saat_khas['l_modat']);  
	 $total_ezafekari_saati['1'] = $total_ezafekari_saati['1']*60;
	 $total_ezafekari_saati['0'] = $total_ezafekari_saati['0']*60*60;
	 $totalkol_ezafekari_saati = $totalkol_ezafekari_saati + $total_ezafekari_saati['1'] + $total_ezafekari_saati['0'];
	  }
	   } ?>
    <?php } while ($row_saat_khas = mysql_fetch_assoc($saat_khas)); ?>
</td>
  </tr>
  </table> 
  </td>
  <td>
  <?php
$karkard = (($total/60)/60);
$karkard_hur = explode(".",$karkard);
$karkard_min = "0.".$karkard_hur[1];
$karkard_min = explode(".",($karkard_min*60));
$karkard_sec = "0.".$karkard_min[1];
$karkard_sec = round($karkard_sec*60);
echo $karkard_hur[0].":".$karkard_min[0].":".$karkard_sec;
$total_kol_karkard = $total_kol_karkard + $total;

//echo "<br/>".$total_kol_karkard;
//echo "<br/>".$karkard;
//echo $total;
  ?>  </td>
  <td nowrap="nowrap">
  <?php  
$mamoriat_saati = ($totalkol_mamorit_saati/60)/60;
$mamoriat_saati_hur = explode(".",$mamoriat_saati);
$mamoriat_saati_min = "0.".$mamoriat_saati_hur['1'];
if($mamoriat_saati!=""){echo "ماموریت و بازرسی = ".$mamoriat_saati_hur['0'].":".round($mamoriat_saati_min*60);}
$mamoriat_saati_kol = $mamoriat_saati_kol + $totalkol_mamorit_saati;

$morakhasi_saati = ($totalkol_morkhasi_saati/60)/60;
$morakhasi_saati_hur = explode(".",$morakhasi_saati);
$morakhasi_saati_min = "0.".$morakhasi_saati_hur['1']; 
if($morakhasi_saati!=""){echo "<br/>مرخصی = ".$morakhasi_saati_hur['0'].":".round($morakhasi_saati_min*60);}
$morakhasi_saati_kol = $morakhasi_saati_kol + $totalkol_morkhasi_saati;

$ezafekari_saati = ($totalkol_ezafekari_saati/60)/60;
$ezafekari_saati_hur = explode(".",$ezafekari_saati);
$ezafekari_saati_min = "0.".$ezafekari_saati_hur['1']; 
if($ezafekari_saati!=""){echo "<br/>اضافه کاری = ".$ezafekari_saati_hur['0'].":".round($ezafekari_saati_min*60);}
$ezafekari_saati_kol = $ezafekari_saati_kol + $totalkol_ezafekari_saati;
  ?></td>
  </tr>  
  <?php  } ?>
</table>
<div align="center">
<?php 
$karkard_kol = (($total_kol_karkard/60)/60);
$karkard_kol_hur = explode(".",$karkard_kol);
$karkard_kol_min = "0.".$karkard_kol_hur[1];
$karkard_kol_min = explode(".",($karkard_kol_min*60));
$karkard_kol_sec = "0.".$karkard_kol_min[1];
$karkard_kol_sec = round($karkard_kol_sec*60);
echo "ساعت های کاری = ".$karkard_kol_hur[0].":".$karkard_kol_min[0].":".$karkard_kol_sec;


$mamoriat_saati_koli = ($mamoriat_saati_kol/60)/60;
$mamoriat_saati_koli_hur = explode(".",$mamoriat_saati_koli);
$mamoriat_saati_koli_min = "0.".$mamoriat_saati_koli_hur['1'];
if($mamoriat_saati_koli!=""){echo "<br/>ماموریت و بازرسی = ".$mamoriat_saati_koli_hur['0'].":".round($mamoriat_saati_koli_min*60);}

$morakhasi_saati_koli = ($morakhasi_saati_kol/60)/60;
$morakhasi_saati_koli_hur = explode(".",$morakhasi_saati_koli);
$morakhasi_saati_koli_min = "0.".$morakhasi_saati_koli_hur['1']; 
if($morakhasi_saati_koli!=""){echo "<br/>مرخصی = ".$morakhasi_saati_koli_hur['0'].":".round($morakhasi_saati_koli_min*60);}


$ezafekari_saati_koli = ($ezafekari_saati_kol/60)/60;
$ezafekari_saati_koli_hur = explode(".",$ezafekari_saati_koli);
$ezafekari_saati_koli_min = "0.".$ezafekari_saati_koli_hur['1']; 
if($ezafekari_saati_koli!=""){echo "<br/>اضافه کاری = ".$ezafekari_saati_koli_hur['0'].":".round($ezafekari_saati_koli_min*60);}

 ?>
 </div>
</body>
</html>
