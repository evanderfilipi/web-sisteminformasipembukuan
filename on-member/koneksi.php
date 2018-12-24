<!-- CONNECT KE DATABASE YANG LEBIH SIMPLE -->

<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "db_pembukuan";
mysql_connect($server,$user,$pass);
mysql_select_db($db);
?>