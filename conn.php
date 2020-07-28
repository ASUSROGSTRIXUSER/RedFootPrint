<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "redfotprint";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno())
{
	echo 'Unknown Database : '.mysqli_connect_error();
}
?>