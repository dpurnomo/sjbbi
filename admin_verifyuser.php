<?php
include_once('includes/secure.php');
if($_SESSION['admin']!=1){
  header("location: index.php");
  exit;
}
include_once('includes/dbconfig.php');
$id = $_GET['id'];  
$sql = "UPDATE users SET verified='1' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
header('location: ./admin.php?a=verifysucess');
} else {
	echo "Error deleting record: ".$sql."<br>" . $conn->error;
}
 $conn->close();

?>