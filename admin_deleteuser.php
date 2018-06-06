<?php
include_once('includes/secure.php');
include_once('includes/dbconfig.php');
if($_SESSION['admin']!=1){
  header("location: index.php");
  exit;
}
$id = $_GET['id'];  
$sql = "DELETE FROM users WHERE id=$id";
if ($conn->query($sql) === TRUE) {
header('location: ./admin.php?a=deletesucess');
} else {
	echo "Error deleting record: ".$sql."<br>" . $conn->error;
}
 $conn->close();

?>