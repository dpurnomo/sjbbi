<?php
$page="meeting_other-form.php";
include_once('includes/secure.php'); // protected page
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
$date = $_POST['date'];  
$type = trim($_POST['type']);  
$location = trim($_POST['location']); 
$notes = trim($_POST['notes']); 
$pdl0 = trim($_POST['pdl0']);
$pdl1 = trim($_POST['pdl1']);
$pdl2 = trim($_POST['pdl2']);
$pdl3 = trim($_POST['pdl3']);

$sql = "INSERT INTO Meetings ( type, date, location, notes, pdl0, pdl1, pdl2, pdl3,createddate,modifieddate,createdby,modifiedby )  VALUES ( '$type', '$date', '$location','$notes', '$pdl0', '$pdl1', '$pdl2', '$pdl3',now(),now(),'$createdby','$modifiedby' )";

if ($conn->query($sql) === TRUE) {
  header("location: meeting.php");
    echo "New record created successfully<br>";
    echo "<a href='./index.php'>Return to Dashboard</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('includes/header.php'); ?>
    <title>Lain-Lain - SJBBI</title>
<link href="css/floatingcustom.css" rel="stylesheet">
</head>
<body class="grad-royal">
<?php include_once('includes/navbar.php'); ?>
<div class="container">
	<div class="card">
	<div class="card-body">
	<div class="text-center">
	<h1>Buat Event Lain-Lain</h1>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="form-label-group">
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:3em;" required/>
<label for="date">TANGGAL</label>
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">TIPE</label>
    <select class="form-control" name="type" id="exampleFormControlSelect1">
	   <option>PDL (Gabungan)</option>
      <option>PDL (KDL)</option>
      <option>Kebaktian Wilayah</option>
      <option>Kebaktian Regional</option>
      <option>Peringatan</option>
      <option>WKP</option>
    </select>
  </div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl0" id="pdl" placeholder="PEMANDU PDL (GABUNGAN)" required/>
<label for="pdl">PEMANDU PDL (GABUNGAN)</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl1" id="pdl" placeholder="PEMANDU PDL KDL 1" required/>
<label for="pdl">PEMANDU PDL KDL 1</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl2" id="pdl" placeholder="PEMANDU PDL KDL 2" required/>
<label for="pdl">PEMANDU PDL KDL 2</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl3" id="pdl" placeholder="PEMANDU PDL KDL 3" required/>
<label for="pdl">PEMANDU PDL KDL 3</label>
</div>

<div class="form-group">
LOKASI
<textarea class="form-control" id="exampleFormControlTextarea1" name="location" rows="5" ></textarea>
</div>

<div class="form-group">
CATATAN
<textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="5" ></textarea>
</div>

<div class="text-center">
<input type="submit" class="btn btn-primary" value="Submit">
<a href="./index.php" class="btn btn-primary">Return</a>
<input type="reset" class="btn btn-danger" value="Reset">
</div>
</div></div>
</div>
</form>
<?php include_once('includes/footer.php'); ?>
</body>
</html>
