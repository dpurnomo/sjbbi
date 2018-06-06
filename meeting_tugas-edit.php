<?php
$page = "meeting_tugas-edit.php";
include_once('includes/secure.php'); // protected page
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
	$tp_pembacaan = trim($_POST["tp_pembacaan"]);
	$tp_pembacaan_no = trim($_POST["tp_pembacaan_no"]);
	$tp_pembacaan_no2 = trim($_POST["tp_pembacaan_no2"]);
	$tp_pembacaan_bahan = trim($_POST["tp_pembacaan_bahan"]);
	$tp_tugas1 = trim($_POST["tp_tugas1"]);
	$tp_tugas1_tipe = trim($_POST["tp_tugas1_tipe"]);
	$tp_tugas1_partner = trim($_POST["tp_tugas1_partner"]);
	$tp_tugas1_no = trim($_POST["tp_tugas1_no"]);
	$tp_tugas1_no2 = trim($_POST["tp_tugas1_no2"]);
	$tp_tugas1_bahan = trim($_POST["tp_tugas1_bahan"]);
	$tp_tugas2 = trim($_POST["tp_tugas2"]);
	$tp_tugas2_tipe = trim($_POST["tp_tugas2_tipe"]);
	$tp_tugas2_partner = trim($_POST["tp_tugas2_partner"]);
	$tp_tugas2_no = trim($_POST["tp_tugas2_no"]);
	$tp_tugas2_no2 = trim($_POST["tp_tugas2_no2"]);
	$tp_tugas2_bahan = trim($_POST["tp_tugas2_bahan"]);
	$tp_tugas3 = trim($_POST["tp_tugas3"]);
	$tp_tugas3_tipe = trim($_POST["tp_tugas3_tipe"]);
	$tp_tugas3_partner = trim($_POST["tp_tugas3_partner"]);
	$tp_tugas3_no = trim($_POST["tp_tugas3_no"]);
	$tp_tugas3_no2 = trim($_POST["tp_tugas3_no2"]);
	$tp_tugas3_bahan = trim($_POST["tp_tugas3_bahan"]);
/*
	echo '<div style="color:white">';
	echo $id;
	echo $tp_pembacaan;
	echo '</div>';
*/
 $sql = "UPDATE Meetings SET tp_pembacaan = '$tp_pembacaan', tp_pembacaan_no = '$tp_pembacaan_no', tp_pembacaan_no2 = '$tp_pembacaan_no2' , tp_pembacaan_bahan = '$tp_pembacaan_bahan', tp_tugas1 = '$tp_tugas1', tp_tugas1_tipe = '$tp_tugas1_tipe',tp_tugas1_partner = '$tp_tugas1_partner', tp_tugas1_no = '$tp_tugas1_no',tp_tugas1_no2 = '$tp_tugas1_no2', tp_tugas1_bahan = '$tp_tugas1_bahan', tp_tugas2 = '$tp_tugas2', tp_tugas2_tipe = '$tp_tugas2_tipe',tp_tugas2_partner = '$tp_tugas2_partner', tp_tugas2_no = '$tp_tugas2_no',tp_tugas2_no2 = '$tp_tugas2_no2', tp_tugas2_bahan = '$tp_tugas2_bahan', tp_tugas3 = '$tp_tugas3', tp_tugas3_tipe = '$tp_tugas3_tipe',tp_tugas3_partner = '$tp_tugas3_partner', tp_tugas3_no = '$tp_tugas3_no',tp_tugas3_no2 = '$tp_tugas3_no2', tp_tugas3_bahan = '$tp_tugas3_bahan', modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: meeting_tugas.php");
} else {
    echo "<p style='color:white;'> Error: " . $sql . "<br>" . $conn->error."</p>";
}
}
?>

<?php
$id = $_GET['id'];  
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM Meetings WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
   while($row = $result->fetch_assoc()) {
	$date = $row["date"];
	$tp_pembacaan = $row["tp_pembacaan"];
	$tp_pembacaan_no = $row["tp_pembacaan_no"];
	$tp_pembacaan_no2 = $row["tp_pembacaan_no2"];
	$tp_pembacaan_bahan = $row["tp_pembacaan_bahan"];
	$tp_tugas1 = $row["tp_tugas1"];
	$tp_tugas1_tipe = $row["tp_tugas1_tipe"];
	$tp_tugas1_partner = $row["tp_tugas1_partner"];
	$tp_tugas1_no = $row["tp_tugas1_no"];
	$tp_tugas1_no2 = $row["tp_tugas1_no2"];
	$tp_tugas1_bahan = $row["tp_tugas1_bahan"];
	$tp_tugas2 = $row["tp_tugas2"];
	$tp_tugas2_tipe = $row["tp_tugas2_tipe"];
	$tp_tugas2_partner = $row["tp_tugas2_partner"];
	$tp_tugas2_no = $row["tp_tugas2_no"];
	$tp_tugas2_no2 = $row["tp_tugas2_no2"];
	$tp_tugas2_bahan = $row["tp_tugas2_bahan"];
	$tp_tugas3 = $row["tp_tugas3"];
	$tp_tugas3_tipe = $row["tp_tugas3_tipe"];
	$tp_tugas3_partner = $row["tp_tugas3_partner"];
	$tp_tugas3_no = $row["tp_tugas3_no"];
	$tp_tugas3_no2 = $row["tp_tugas3_no2"];
	$tp_tugas3_bahan = $row["tp_tugas3_bahan"];
	    	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('includes/header.php'); ?>
    <title>Tugas - SJBBI</title>
<link href="css/floatingcustom.css" rel="stylesheet">
<style>
	label, input {text-align:left;}
</style>
</head>
<body style="text-align:left;" class="grad-royal">
<?php include_once('includes/navbar.php'); ?>
<div class="container">
<div class="card">
<div class="card-body">
	<div class="text-center">
	<h1 style="margin-bottom:0px;">Tugas Siswa</h1>
	<?php echo "<p style='font-size:10px;'>ID #".$id." | ".$date."</p>"?>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<h4>📖 Pembacaan</h4>
<div class="form-group">
    <small class="form-text text-muted">Siswa</small>
    <input type="text" class="form-control" name="tp_pembacaan" placeholder="Siswa" value="<?php echo $tp_pembacaan; ?>">
    <small class="form-text text-muted">Bahan</small>
    <input type="text" class="form-control" name="tp_pembacaan_bahan" placeholder="Bahan" value="<?php echo $tp_pembacaan_bahan; ?>">
    <small class="form-text text-muted">Nomor Nasihat</small>
    <input type="text" class="form-control" name="tp_pembacaan_no" placeholder="Nomor Nasihat" value="<?php echo $tp_pembacaan_no; ?>">
    <small class="form-text text-muted">Nasihat Berikut/Catatan</small>
    <input type="text" class="form-control" name="tp_pembacaan_no2" placeholder="Nasihat Berikut/Catatan" value="<?php echo $tp_pembacaan_no2; ?>">    
  </div>
  
<h4>📚 Tugas 1</h4>
<div class="form-group">
    <small class="form-text text-muted">Tipe (Pengabaran, KK, PAR, Khotbah, dll)</small>
    <input type="text" class="form-control" name="tp_tugas1_tipe" placeholder="Tipe" value="<?php echo $tp_tugas1_tipe; ?>">
    <small class="form-text text-muted">Bahan</small>
    <input type="text" class="form-control" name="tp_tugas1_bahan" placeholder="Bahan" value="<?php echo $tp_tugas1_bahan; ?>">
    <small class="form-text text-muted">Siswa</small>
    <input type="text" class="form-control" name="tp_tugas1" placeholder="Siswa" value="<?php echo $tp_tugas1; ?>">
    <small class="form-text text-muted">Partner</small>
    <input type="text" class="form-control" name="tp_tugas1_partner" placeholder="Partner" value="<?php echo $tp_tugas1_partner; ?>">
    <small class="form-text text-muted">Nomor Nasihat</small>
    <input type="text" class="form-control" name="tp_tugas1_no" placeholder="Nomor Nasihat" value="<?php echo $tp_tugas1_no; ?>">
    <small class="form-text text-muted">Nasihat Berikut/Catatan</small>
    <input type="text" class="form-control" name="tp_tugas1_no2" placeholder="Nasihat Berikut/Catatan" value="<?php echo $tp_tugas1_no2; ?>">    
  </div>
  
<h4>📚 Tugas 2</h4>
<div class="form-group">
    <small class="form-text text-muted">Tipe (Pengabaran, KK, PAR, Khotbah, dll)</small>
    <input type="text" class="form-control" name="tp_tugas2_tipe" placeholder="Tipe" value="<?php echo $tp_tugas2_tipe; ?>">
    <small class="form-text text-muted">Bahan</small>
    <input type="text" class="form-control" name="tp_tugas2_bahan" placeholder="Bahan" value="<?php echo $tp_tugas2_bahan; ?>">
    <small class="form-text text-muted">Siswa</small>
    <input type="text" class="form-control" name="tp_tugas2" placeholder="Siswa" value="<?php echo $tp_tugas2; ?>">
    <small class="form-text text-muted">Partner</small>
    <input type="text" class="form-control" name="tp_tugas2_partner" placeholder="Partner" value="<?php echo $tp_tugas2_partner; ?>">
    <small class="form-text text-muted">Nomor Nasihat</small>
    <input type="text" class="form-control" name="tp_tugas2_no" placeholder="Nomor Nasihat" value="<?php echo $tp_tugas2_no; ?>">
    <small class="form-text text-muted">Nasihat Berikut/Catatan</small>
    <input type="text" class="form-control" name="tp_tugas2_no2" placeholder="Nasihat Berikut/Catatan" value="<?php echo $tp_tugas2_no2; ?>">    
  </div>

  <h4>📚 Tugas 3</h4>
<div class="form-group">
    <small class="form-text text-muted">Tipe (Pengabaran, KK, PAR, Khotbah, dll)</small>
    <input type="text" class="form-control" name="tp_tugas3_tipe" placeholder="Tipe" value="<?php echo $tp_tugas3_tipe; ?>">
    <small class="form-text text-muted">Bahan</small>
    <input type="text" class="form-control" name="tp_tugas3_bahan" placeholder="Bahan" value="<?php echo $tp_tugas3_bahan; ?>">
    <small class="form-text text-muted">Siswa</small>
    <input type="text" class="form-control" name="tp_tugas3" placeholder="Siswa" value="<?php echo $tp_tugas3; ?>">
    <small class="form-text text-muted">Partner</small>
    <input type="text" class="form-control" name="tp_tugas3_partner" placeholder="Partner" value="<?php echo $tp_tugas3_partner; ?>">
    <small class="form-text text-muted">Nomor Nasihat</small>
    <input type="text" class="form-control" name="tp_tugas3_no" placeholder="Nomor Nasihat" value="<?php echo $tp_tugas3_no; ?>">
    <small class="form-text text-muted">Nasihat Berikut/Catatan</small>
    <input type="text" class="form-control" name="tp_tugas3_no2" placeholder="Nasihat Berikut/Catatan" value="<?php echo $tp_tugas3_no2; ?>">    
  </div>

<div class="text-center">
<input type="submit" class="btn btn-primary" value="Submit">
<a href="./meeting_tugas.php" class="btn btn-primary">Return</a>
</div>
</div>
</div>
</div>
</form>
<?php include_once('includes/footer.php'); ?>
</body>
</html>
