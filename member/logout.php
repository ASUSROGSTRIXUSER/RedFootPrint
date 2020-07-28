<?php
include ("session.php");
$user_id = $row['user_id'];

if(!isset($_SESSION['user']))
{
	header("Location:../index.php");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location:../index.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location:../index.php");
}
?>