<?php
include_once('includes/secure.php'); 
include_once('includes/dbconfig.php'); 
$id = $_GET['id'];  
$sql = "DELETE FROM Meetings WHERE id=$id";
if ($conn->query($sql) === TRUE) {
header('location: ./index.php?a=deletesucess');
} else {
	echo "Error deleting record: " . $conn->error;
}
 $conn->close();
?>
