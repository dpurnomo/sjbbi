<?php
$id = $_GET['id'];
$origin = $_GET['p'];  
$page = "person_awayshow.php?id=" . $id;
include_once('includes/secure.php');
$updatesuccess=""
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
$id = $_POST['id'];
$modifiedby = $_SESSION['username'];
$startdate = $_POST['startdate'];  
$enddate = $_POST['enddate'];  
$person = trim($_POST['person']);
$notes = trim($_POST['notes']);
$sql = "UPDATE away SET startdate='$startdate', enddate='$enddate',person='$person',notes='$notes', modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
	$updatesuccess = '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Record berhasil diupdate!
</div>';
    // header("location: person_awayshow.php?id=" . $id);
} else {
    echo "<p style='color:white;'> Error: " . $sql . "<br>" . $conn->error."</p>";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Away Persons - SJBBI</title>
<?php include_once('includes/header.php'); ?>		
<style>
pre {font-family: "Helvetica";font-size: 1em;}
</style>	
</head>
	<body class="grad-royal">
<?php include_once('includes/navbar.php'); ?>
		<?php echo $updatesuccess; ?>
<div class="container">
<div class="row">
<?php
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM away WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$sql1startdate = date_create($row["startdate"]);
    	$sql1enddate = date_create($row["enddate"]);
    	$sqlstartdate = $row["startdate"];
    	$sqlenddate = $row["enddate"];
		
		$startdate = date_format($sql1startdate, 'j M y');
		$enddate = date_format($sql1enddate, 'j M y');
		$person = $row["person"];
		$notes = $row["notes"];
    	}
			
} else {
    echo "0 results";
}
echo "</p></center>"
?>

<div class="col">
<div class="card">
<div class="card-body">
<h4 class="card-title">Away</h4>
<p class="card-text"><b>Nama:</b><br><?php echo $person; ?></p>
<p class="card-text"><b>Tanggal Mulai:</b><br><?php echo $startdate; ?></p>
<p class="card-text"><b>Tanggal Selesai:</b><br><?php echo $enddate; ?></p>
<p class="card-text"><?php echo $notes; ?></p>

<p>
<center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Edit</button> <a href="person_awaydelete.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a> </center></p>
</div>
</div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-plane"></i> Away</a></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		  	<div class="form-group">
    		<label for="nama">Nama</label>
    		<input type="text" class="form-control" name="person" id="nama" placeholder="Nama" value="<?php echo $person; ?>">
  			</div>

			<div class="form-group">
    		<label for="startdate">Tanggal Mulai</label>
    		<input style="height:2.5em;" type="date" class="form-control" name="startdate" id="startdate" placeholder="Tanggal Mulai" value="<?php echo $sqlstartdate; ?>">
  			</div>

			<div class="form-group">
    		<label for="startdate">Tanggal Selesai</label>
    		<input style="height:2.5em;" type="date" class="form-control" name="enddate" id="enddate" placeholder="Tanggal Selesai" value="<?php echo $sqlenddate; ?>">
  			</div>
			<div class="form-group">
			Catatan:
    		<textarea class="form-control" id="catatan" name="notes" rows="5" ><?php echo $notes; ?></textarea>
  			</div>
  		<input type="submit" value="Update" class="btn btn-primary" />
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



