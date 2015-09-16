<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_con_knap = "localhost";
$database_con_knap = "knap";
$username_con_knap = "root";
$password_con_knap = "";
error_reporting(0);
$con_knap = mysql_pconnect($hostname_con_knap, $username_con_knap, $password_con_knap) or trigger_error(mysql_error(),E_USER_ERROR); 
?>