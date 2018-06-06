<?php
// Initialize the session
session_start();

	$s = $_GET['s'];
	$platform = $_GET['platform'];
	$m = $_GET['m'];
  $v = $_GET['v'];
	$manufacturer = $_GET['manufacturer'];
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php?p=".$page."&u=".$u."&s=".$s."&m=".$m."&platform=".$platform."&v=".$v."&manufacturer=".$manufacturer);
  exit;
}
// Catch unverified
if($_SESSION['verified'] != 1){
  	header("location: needverification.php");
	exit;
}

// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);

?>