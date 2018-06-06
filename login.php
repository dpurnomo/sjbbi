<?php
ini_set('session.cookie_lifetime', 31536000);
ini_set('session.gc_maxlifetime', 31536000);
// Include config file
require_once 'includes/dbconfig.php';
// Get origin page
$page = $_GET['p'];
$posteduuid = $_GET['u'];
$postedserial = $_GET['s'];
$postedplatform = $_GET['platform'];
$postedmodel = $_GET['m'];
$postedversion = $_GET['v'];
$manufacturer = $_GET['manufacturer'];


//uuid login
if (!empty($posteduuid)){
$sql = "SELECT * FROM usersdevices WHERE uuid='$posteduuid' LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$uuid = $row['uuid'];
			$username = $row['username'];
			$verified = $row['verified'];
			if ($posteduuid==$uuid && !empty($username) && $verified == 1 ){
				session_start();
				$_SESSION['username'] = $username;
				$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
							$_SESSION['admin'] = $row['admin']; 
							$_SESSION['verified'] = $row['verified']; 
							$_SESSION['elder'] = $row['elder'];
						  $_SESSION['firstname'] = $row['firstname'];
							$_SESSION['lastname'] = $row['lastname'];
					}
					//header('location: index.php');
				}
				$sql = "UPDATE users SET last_login=now() WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
header("location: index.php");
exit;
	}
			}
		}
	}
}



//Admin login development
if ($_SERVER['USER'] == 'mobile' ||$_SERVER['USER'] == 'dpurnomo') {
$username = 'dpurnomo';
session_start();							  
$_SESSION['username'] = $username; 
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$_SESSION['firstname'] = $row['firstname'];
	$_SESSION['lastname'] = $row['lastname'];
	$_SESSION['admin'] = $row['admin']; 
	$_SESSION['verified'] = $row['verified']; 
	$_SESSION['elder'] = $row['elder'];
	}
}
//Support going directly to origin page
if(!isset($page) || empty($page)){
header("location: index.php");
exit;
} else {
header("location: ".$page);
exit;
	}
}
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Tolong isi nama user';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Tolong isi password';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
//        $sql = "SELECT * FROM users WHERE username = ?";
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
							  
							  $_SESSION['username'] = $username; 

							//start
									// Check connection
									$username = $_SESSION['username'];
									$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							      		$_SESSION['firstname'] = $row['firstname'];
							      		$_SESSION['lastname'] = $row['lastname'];
							      		$_SESSION['admin'] = $row['admin']; 
											$_SESSION['verified'] = $row['verified']; 
											$_SESSION['elder'] = $row['elder']; 
									}
										
$mailto = "dpurnomo@outlook.com";
$mailsubject = '[SJBBI] '.$_SESSION['username'] . ' just logged in';
$mailbody = '<b>'. $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . '</b> just logged in to SJBBI!<br>Device Model: '. $postedmodel;
$mailbodyalt = $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . ' just logged in to SJBBI!';
										
						if (!empty($posteduuid)){
						$sql = "INSERT INTO usersdevices ( uuid,username,serial,platform,model,version,manufacturer)  VALUES ( '$posteduuid', '$username','$postedserial','$postedplatform','$postedmodel','$postedversion','$manufacturer')";
						if ($conn->query($sql) === TRUE) {
							$mailto = "dpurnomo@outlook.com";
							$mailsubject = '[SJBBI] UNVERIFIED UUID: '.$_SESSION['username'] . ' just logged in';
							$mailbody = '<b>'. $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . '</b> just logged in to SJBBI!<br>'.
								'<b>Device Model: </b>'. $postedmodel . 
								'<br><b>Device UUID:</b> ' . $posteduuid .
								'<br><b>Device Serial:</b> ' . $postedserial .
								'<br><b>Device Platform:</b> ' . $postedplatform .
								'<br><b>Device Manufacturer:</b> ' . $manufacturer .
								'<br><b>Device Version:</b> ' . $postedversion ;
							$mailbodyalt = $_SESSION['firstname'] . ' '. $_SESSION['lastname'] . ' just logged in to SJBBI!';
						} else {
							
						}
				}
//Send email logging in										

include_once ('sendmail.php');
//--------------------
							     
							} else {
							    echo "0 results";
							}
							
							//end                            
							$sql = "UPDATE users SET last_login=now() WHERE username='$username'";
if ($conn->query($sql) === TRUE) {

//Support going directly to origin page
if(!isset($page) || empty($page)){
header("location: index.php");
exit;
} else {
header("location: ".$page);
exit;
	}

}
                            
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Password salah.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                     $username_err = 'Nama user tidak ditemukan.';
						
                }
            } else{
                echo "Waduh! Ada yang salah! Coba lagi nanti.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<?php include_once('includes/header.php'); ?>
<link href="css/floating-formlabel.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
</head>
<body class="grad-royal">
    <div class="wrapper">
		<div class="card">
		<div class="card-body">
		<div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-users"></i> SJBBI<?= $msg ?></h1>
        <p>Masukkan nama user dan password untuk login</p>
		</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

				<div class="form-label-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Nama User" value="<?php echo $username; ?>" required autofocus="">
					<label for="username">Nama User</label>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
					<label for="password">Password</label>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
				<div class="text-center">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
<p class="card-text">Belum punya akun? <a href="register.php">Buat akun sekarang</a>.</p>
</div></div>

</div>
        </form>
    </div>    
</body>
</html>