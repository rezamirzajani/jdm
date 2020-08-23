<?php
if(isset($_GET['true']) && $_GET['true'] =="ok"){
  setcookie("taradode_company", "");
  setcookie("name_famili_user", "");
 // echo $_SERVER['REMOTE_ADDR'];
header("location: sabt_taradod.php");
}else{
header("location: sabt_taradod.php");
}
?>
