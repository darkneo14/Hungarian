<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_con_hung = "localhost";
$database_con_hung = "hung";
$username_con_hung = "root";
$password_con_hung = "";
error_reporting(0);
$con_hung = mysql_pconnect($hostname_con_hung, $username_con_hung, $password_con_hung) or trigger_error(mysql_error(),E_USER_ERROR); 
?>