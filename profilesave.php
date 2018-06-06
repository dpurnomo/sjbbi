<?php 
include_once('includes/secure.php');
include_once('includes/dbconfig.php');

$firstname = $_POST['firstname'];  
$lastname = $_POST['lastname'];
$password = $_POST['password'];  
$user = $_SESSION['username'];
if ($password == "" || empty($password)){
$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname' WHERE username='$user'";

	if ($conn->query($sql) === TRUE) {
												$sql = "SELECT * FROM users WHERE username='$user' LIMIT 1";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
										    // output data of each row
										    while($row = $result->fetch_assoc()) {
//Update session data
   	$_SESSION['firstname'] = $row['firstname'];
		$_SESSION['lastname'] = $row['lastname'];
		$_SESSION['admin'] = $row['admin'];
		header('location: ./index.php?a=profilesaved');
		die(); 	
										    } 
//Reload session variables ends
	
    	echo '<br><a href="index.php">Return to main site</a>';
		}} else {
    echo "Error updating record: " . $conn->error;
    echo '<br><a href="index.php">Return to main site</a>';
		} 
} else {
$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', password='$param_password' WHERE username='$user'";

	if ($conn->query($sql) === TRUE) {
												$sql = "SELECT * FROM users WHERE username='$user' LIMIT 1";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
										    // output data of each row
										    while($row = $result->fetch_assoc()) {
//Update session data
   	$_SESSION['firstname'] = $row['firstname'];
		$_SESSION['lastname'] = $row['lastname'];
		$_SESSION['admin'] = $row['admin'];
		header('location: ./index.php?a=profilepasswordsaved');
		die(); 	
										    } 
//Reload session variables ends
	
    	echo '<br><a href="index.php">Return to main site</a>';
		}} else {
    echo "Error updating record: " . $conn->error;
    echo '<br><a href="index.php">Return to main site</a>';
		}

}

$conn->close();
?>
</body>
</html>