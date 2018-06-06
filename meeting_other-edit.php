<?php
$page="meeting_other-edit.php";
include_once('includes/secure.php'); // protected page
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
$modifiedby = $_SESSION['username'];
$date = $_POST['date'];  
$type = trim($_POST['type']);  
$location = trim($_POST['location']); 
$notes = trim($_POST['notes']); 
$pdl0 = trim($_POST['pdl0']);
$pdl1 = trim($_POST['pdl1']);
$pdl2 = trim($_POST['pdl2']);
$pdl3 = trim($_POST['pdl3']);

$sql = "UPDATE Meetings SET type='$type', date='$date', location='$location', notes='$notes', pdl0='$pdl0',pdl1='$pdl1',pdl2='$pdl2',pdl3='$pdl3', modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  header("location: meeting.php?a=editsuccess");
    echo "New record created successfully<br>";
    echo "<a href='./index.php'>Return to Dashboard</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}
?>

<?php
$id = $_GET['id'];  
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM Meetings WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {	     
	$date = $row["date"]; 
	$type = $row["type"];
	$location = $row["location"];
	$notes = $row["notes"]; 
	$pdl0 = $row["pdl0"];
	$pdl1 = $row["pdl1"];
	$pdl2 = $row["pdl2"];
	$pdl3 = $row["pdl3"];
    } 
} else {

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('includes/header.php'); ?>
    <title>Lain-Lain - SJBBI</title>
<link href="css/floatingcustom.css" rel="stylesheet">
<style>
	input, label {text-align: left;}
	</style>
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
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:3em;" value="<?php echo $date;?>" required/>
<label for="date">TANGGAL</label>
</div>

<div class="form-group text-left">
    <label for="exampleFormControlSelect1">TIPE</label>
    <select class="form-control" name="type" id="exampleFormControlSelect1">
	  <option>PDL (Gabungan)</option>
      <option>PDL (KDL)</option>
      <option>Kebaktian Wilayah</option>
      <option>Kebaktian Regional</option>
      <option<?php if($type="Peringatan"){echo " selected";} ?> >Peringatan</option>
      <option>WKP</option>
    </select>
  </div>
<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id;?>" />

<div class="form-label-group">
<input type="text" class="form-control" name="pdl0" id="pdl" placeholder="PEMANDU PDL (GABUNGAN)" value="<?php echo $pdl0;?>" />
<label for="pdl">PEMANDU PDL (GABUNGAN)</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl1" id="pdl" placeholder="PEMANDU PDL KDL 1" value="<?php echo $pdl1;?>" />
<label for="pdl">PEMANDU PDL KDL 1</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl2" id="pdl" placeholder="PEMANDU PDL KDL 2" value="<?php echo $pdl2;?>" />
<label for="pdl">PEMANDU PDL KDL 2</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="pdl3" id="pdl" placeholder="PEMANDU PDL KDL 3" value="<?php echo $pdl3;?>"/>
<label for="pdl">PEMANDU PDL KDL 3</label>
</div>

<div class="form-group text-left">
LOKASI
<textarea class="form-control" id="exampleFormControlTextarea1" name="location" rows="5" ><?php echo $location;?></textarea>
</div>

<div class="form-group text-left">
CATATAN
<textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="5" ><?php echo $notes;?></textarea>
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
