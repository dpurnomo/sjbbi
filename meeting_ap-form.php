<?php
include_once('includes/secure.php'); // protected page

if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
$date = $_POST['date'];  
$ap_ketua = trim($_POST['ap_ketua']);  
$ap_ku = trim($_POST['ap_ku']); 
$ap_penerjemah = trim($_POST['ap_penerjemah']); 
$ap_mp = trim($_POST['ap_mp']);
$ap_tavis1 = trim($_POST['ap_tavis1']);
$ap_tavis2 = trim($_POST['ap_tavis2']);
$ap_tatib = trim($_POST['ap_tatib']);
$ap_kebersihan = trim($_POST['ap_kebersihan']);
$ap_pdl = trim($_POST['ap_pdl']);

$sql = "INSERT INTO Meetings ( type, date, ap_ketua, ap_ku, ap_penerjemah, ap_mp, ap_tavis1, ap_tavis2, ap_tatib, 
ap_kebersihan, ap_pdl,createddate,modifieddate,createdby,modifiedby )  VALUES ( 'Akhir Pekan', 
'$date', '$ap_ketua','$ap_ku','$ap_penerjemah', '$ap_mp', '$ap_tavis1', '$ap_tavis2', '$ap_tatib', '$ap_kebersihan', 
'$ap_pdl',now(),now(),'$createdby','$modifiedby' )";

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
    <title>AP - SJBBI</title>
<link href="css/floating-formlabel.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<div class="text-center">
	<h1>Buat Perhimpunan Akhir Pekan</h1>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-label-group">
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:3em;" required/>
<label for="date">TANGGAL</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_ketua" id="ketua" placeholder="KETUA" />
<label for="ketua">KETUA</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_ku" id="ku" placeholder="KHOTBAH UMUM"/>
<label for="ku">KHOTBAH UMUM</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_penerjemah" id="penerjemah" placeholder="PENERJEMAH"/>
<label for="penerjemah">PENERJEMAH</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_mp" id="mp" placeholder="PEMANDU MP"/>
<label for="mp">PEMANDU MP</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_tavis1" id="tavis1" placeholder="TATA VISUAL 1"/>
<label for="tavis1">TATA VISUAL 1</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_tavis2" id="tavis2" placeholder="TATA VISUAL 2"/>
<label for="tavis2">TATA VISUAL 2</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_tatib" id="tatib" placeholder="TATA TERTIB"/>
<label for="tatib">TATA TERTIB</label>
</div>
<div class="form-label-group">
<input type="text" class="form-control" name="ap_kebersihan" id="kebersihan" placeholder="KEBERSIHAN"/>
<label for="kebersihan">KEBERSIHAN</label>
</div>
<div class="form-label-group">
<input type="text" class="form-control" name="ap_pdl" id="pdl" placeholder="PEMANDU PDL"/>
<label for="pdl">PEMANDU PDL</label>
</div>

<div class="text-center">
<input type="submit" class="btn btn-primary" value="Submit">
<a href="./index.php" class="btn btn-primary">Return</a>
<input type="reset" class="btn btn-danger" value="Reset">
</div>

</div>
</form>
<?php include_once('includes/footer.php'); ?>
</body>
</html>
