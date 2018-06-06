<?php
include_once('includes/secure.php');
include_once('includes/dbconfig.php');
$id = $_GET['id'];  
$sql = "DELETE FROM away WHERE id=$id";
if ($conn->query($sql) === TRUE) {
header('location: ./person_away.php?a=deletesucess');
} else {
	echo "Error deleting record: ".$sql."<br>" . $conn->error;
}
 $conn->close();

?>