<?php
define('DB_SERVER','localhost');
define('DB_USER','u733466350_root');
define('DB_PASS' ,'Admin@123');
define('DB_NAME', 'u733466350_cmspro');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>