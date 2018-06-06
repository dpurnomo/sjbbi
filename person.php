<?php
$page="person.php";
$nav_id = 7;
include_once('includes/secure.php');
$origin = $_GET['p'];
?>
	<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
$startdate = $_POST['startdate'];  
$enddate = $_POST['enddate'];  
$person = trim($_POST['person']);
$notes = trim($_POST['notes']);  

$sql = "INSERT INTO away ( startdate, enddate, person, notes,createddate,modifieddate,createdby,modifiedby )  VALUES ( '$startdate', '$enddate', '$person','$notes', now(),now(),'$createdby','$modifiedby' )";

if ($conn->query($sql) === TRUE) {
  header("location: person_away.php?a=entrycreated");
    echo "New record created successfully<br>";
    echo "<a href='./index.php'>Return to Dashboard</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}
?>

		<html>

		<head>
			<title>Person</title>
			<?php include_once('includes/header.php'); 
?>
		</head>

		<body class="grad-royal">
			<?php include_once('includes/navbar.php'); ?>
			<div class="container">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title text-center"><i class="fas fa-user"></i> Person</a>
						</h3>
						<div class="list-group-flush">
						<?php include_once('includes/dbconfig.php');
		$sql = "SELECT * FROM persons ORDER BY lastname";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$firstname = $row['firstname'];
		    	$lastname = $row['lastname'];
		    echo '<a href="person_show.php?id='.$row['person_id'].'" class="list-group-item list-group-item-action flex-column align-items-start"> <div class="d-flex w-100 justify-content-between">';
		    echo $lastname . ', '. $firstname;
		    echo '</div></a>';
		    }
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
		</div>
						<p>
							<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">+</button></center>
						</p>
					</div>
				</div>
			</div>

			<div class="modal fade" id="myModal">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title"><i class="fas fa-plane"></i> Away</a>
							</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<div class="modal-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" class="form-control" name="person" id="nama" placeholder="Nama" value="<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>">
								</div>

								<div class="form-group">
									<label for="startdate">Tanggal Mulai</label>
									<input style="height:2.5em;" type="date" class="form-control" name="startdate" id="startdate" placeholder="Tanggal Mulai">
								</div>

								<div class="form-group">
									<label for="startdate">Tanggal Selesai</label>
									<input style="height:2.5em;" type="date" class="form-control" name="enddate" id="enddate" placeholder="Tanggal Selesai">
								</div>
								<div class="form-group">
									Catatan:
									<textarea class="form-control" id="catatan" name="notes" rows="5"></textarea>
								</div>
								<div class="text-center">
									<input class="btn btn-primary" type="submit" value="Save" />
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<?php include_once('includes/footer.php'); ?>
		</body>

		</html>