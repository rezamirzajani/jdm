<?php require_once('../Connections/taradod.php'); ?>
<?php

/*$ip = "192.168.1.2";
$c= "5d7aa06df20194e2810e519d3a14f31c";

mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_ip_check1 = "SELECT ip FROM ip inner join vaset_karman_ip on idp = idip inner join karmand on idkarmand = idk where mac = '$c'";
$ip_check1 = mysql_query($query_ip_check1, $taradod) or die(mysql_error());
$row_ip_check1 = mysql_fetch_assoc($ip_check1);
$totalRows_ip_check1 = mysql_num_rows($ip_check1);
$i=0; do {  $arry_ip[$i] = $row_ip_check1['ip']; $i++;} while ($row_ip_check1 = mysql_fetch_assoc($ip_check1));*/

/* $qury_big = "select * from karmand ";
  $big = mysql_query($qury_big, $taradod);
  $row_big = mysql_fetch_assoc($big);
  $idk = $row_big['idk'];
  $companyid = $row_big['companyid'];
  echo $idk;
  echo $companyid;

print_r($arry_ip);
mysql_free_result($ip_check1);*/
mysql_query('set names "utf8"', $taradod);
mysql_select_db($database_taradod, $taradod);
$query_select_karmand = sprintf("SELECT * FROM karmand inner join vaset_karman_dastmozd on karmand.idk = vaset_karman_dastmozd.idvk inner join dastmozd on vaset_karman_dastmozd.idvd = dastmozd.idd WHERE mac = '%s' and tarikh_shoroe_etebar <= '$tt' and tarikh_payan_etebar >= '$tt' ORDER BY idvki DESC ", $colname_select_karmand);
$select_karmand = mysql_query($query_select_karmand, $taradod) or die("GJHGJG");
$row_select_karmand = mysql_fetch_assoc($select_karmand);
$totalRows_select_karmand = mysql_num_rows($select_karmand);
$idk = $row_select_karmand['idk'];
echo $row_select_karmand['name'];
?>