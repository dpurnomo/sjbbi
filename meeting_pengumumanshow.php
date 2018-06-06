<?php
$id = $_GET['id'];
$origin = $_GET['p'];  
$page = "meeting_pengumumanshow.php?id=" . $id;
include_once('includes/secure.php');
include_once('includes/Parsedown.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
$modifiedby = $_SESSION['username'];
$pengumuman = trim($_POST['tp_pengumuman']); 

$sql = "UPDATE Meetings SET tp_pengumuman='$pengumuman', modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: meeting_pengumumanshow.php?id=" . $id);
//echo "$id is: " . $id;
//	echo $sql;
} else {
    echo "<p style='color:white;'> Error: " . $sql . "<br>" . $conn->error."</p>";
}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pengumuman - SJBBI</title>
<?php include_once('includes/header.php'); ?>		
<style>
pre {font-family: "Helvetica";font-size: 1em;}
</style>	
</head>
	<body class="grad-royal">
<?php include_once('includes/navbar.php'); ?>
<div class="container">
<div class="row">
<?php
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM Meetings WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$type = $row["type"];
    	$sqldate = date_create($row["date"]);
		$date = date_format($sqldate, 'j M y');
		$tp_pengumuman = Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_pengumuman']); 
			$tp_pengumuman1 = $row['tp_pengumuman'];
    	}
			
} else {
    echo "0 results";
}
echo "</p></center>"
?>

<div class="col">
<div class="card">
<div class="card-body">
<h4 class="card-title">Pengumuman <?php echo $date ?></h4>

<p class="card-text"><?php echo $tp_pengumuman; ?>
</p>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Edit
</button>
</div>
</div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Pengumuman <?php echo $date ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
	  		<div class="form-group">
    		<textarea class="form-control" id="exampleFormControlTextarea1" name="tp_pengumuman" rows="10" ><?php echo $tp_pengumuman1; ?></textarea>
  			</div>
		<div class="text-center">
  		<input class="btn btn-primary" type="submit" value="Save"/><br>
		<div><p></p>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div></div>
<?php include_once('includes/footer.php'); ?>
</body>
</html>



