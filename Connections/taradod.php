<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_taradod = "localhost";
$database_taradod = "taradod";
$username_taradod = "root";
$password_taradod = "";
/*$hostname_taradod = "localhost";
$database_taradod = "exooir_traffic";
$username_taradod = "mahmood.agah@gmail.com";
$password_taradod = "JPEgfIb7h8";*/
$taradod = mysql_pconnect($hostname_taradod, $username_taradod, $password_taradod) or trigger_error(mysql_error(),E_USER_ERROR); 
?>