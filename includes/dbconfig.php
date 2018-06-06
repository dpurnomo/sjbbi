<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$cwd = strlen(getcwd());

if ($cwd > 90||$_SERVER['USER']=='dpurnomo') {
define('DB_SERVER', '159.65.128.157');
define('DB_USERNAME', 'remoteuser');
define('DB_PASSWORD', 'purnomo1234');
define('DB_NAME', 'sjbbi');
} else {
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'remoteuser');
define('DB_PASSWORD', 'purnomo1234');
define('DB_NAME', 'sjbbi');
}
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
//	echo "Connected successfully to server."; 
}
?>