<?php
$page = "admin.php";
$nav_id = 2;
include_once('includes/secure.php');
if($_SESSION['admin']!=1){
  header("location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
	<head>
<?php include_once ('includes/header.php'); ?>
		<title>￼Admin Page</title>
		<link rel="stylesheet" href="./css/common.css">
	</head>
	<body class="grad-royal">
<?php include_once ('includes/navbar.php'); ?>
<div class="container">
<div class="row">
<div class="col">
<div class="card">
<div class="card-body">
		<h1 class="card-title text-center">USERS</h1>
<?php
include_once('includes/dbconfig.php');
		
		$sql = "SELECT * FROM users ORDER BY id";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Verified</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Admin</th><th>Elder<th>Created At</th><th>Last Login</th><th>ID</th><th>Command</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
				$id = $row['id'];
		    	if($row['admin']==0){
		    		$isadmin = "";
		    	} else {
		    		$isadmin = '<i class="far fa-check-circle" style="color:green"></i>';
		    	}
				if($row['verified']==0){
		    		$verified = '<i class="far fa-times-circle" style="color:red"></i><br><a href="./admin_verifyuser.php?id='.$id.'">Verify</a>';
		    	} else {
		    		$verified = '<i class="far fa-check-circle" style="color:green"></i>';
		    	}
		    	if($row['elder']==0){
		    		$elder = "";
		    	} else {
		    		$elder = '<i class="far fa-check-circle" style="color:green"></i>';
		    	}
		        $date = date_create($row["created_at"]);
		        echo "<tr><td class='text-center'>".$verified."</td><td>".$row['username']."</td><td>".$row['firstname']."</td><td>".$row['lastname']. "</td><td class='text-center'>". $isadmin."</td><td class='text-center'>". $elder ."</td><td>". $row['created_at']."</td><td>".$row['last_login']."</td><td>". $row['id'] ."</td><td><a href='./admin_deleteuser.php?id=".$id."'>Delete</a></td></tr>";
		    }
		    echo "</table></center></div>";
		} else {
		    echo "0 results";
		}
		$conn->close();
		?>
</div></div></div>
<div class="col">
<div class="card">
<div class="card-body">
<h3 class="card-title">LINKS</h3>
<a href="https://purnomo.net/phpmyadmin">PHP MyAdmin</a>
</div>
</div>
</div>

</div></div>
		<?php include_once('includes/footer.php'); ?>
	</body>
</html>
