<?php
include_once('includes/secure.php'); // protected page

if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
$date = $_POST['date'];  
$tp_ketua = trim($_POST['tp_ketua']);  
$tp_khotbah = trim($_POST['tp_khotbah']);  
$tp_menggali = trim($_POST['tp_menggali']);
$tp_bagian1 = trim($_POST['tp_bagian1']);  
$tp_bagian2 = trim($_POST['tp_bagian2']);  
$tp_pas = trim($_POST['tp_pas']);  
$tp_doatutup = trim($_POST['tp_doatutup']);  
$tp_tavis1 = trim($_POST['tp_tavis1']);
$tp_tavis2 = trim($_POST['tp_tavis2']);
$tp_tatib = trim($_POST['tp_tatib']);
$tp_kebersihan = trim($_POST['tp_kebersihan']);

$sql = "INSERT INTO Meetings ( type, date, tp_ketua, tp_khotbah, tp_menggali, tp_bagian1, tp_bagian2, tp_pas, tp_doatutup, tp_tavis1, tp_tavis2, tp_tatib, tp_kebersihan,createddate,modifieddate,createdby,modifiedby )  VALUES ( 'Tengah Pekan', '$date', '$tp_ketua', '$tp_khotbah', '$tp_menggali', '$tp_bagian1', '$tp_bagian2', '$tp_pas', '$tp_doatutup', '$tp_tavis1', '$tp_tavis2', '$tp_tatib', '$tp_kebersihan',now(),now(),'$createdby','$modifiedby' )";

if ($conn->query($sql) === TRUE) {
	header("location: meeting.php?a=tpcreatesuccess");
	exit;
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
    <title>TP - SJBBI</title>
<link href="css/floating-formlabel.css" rel="stylesheet">
</head>
<body class="bg-light" style="height:auto;">
<div class="container" style="height:auto;">
	<div class="text-center">
	<h1>Buat Perhimpunan Tengah Pekan</h1>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-label-group">
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:3em;" required/>
<label for="date">TANGGAL</label>
</div>


<div class="row">
<div class="col-sm-6">
<div class="form-label-group">
<input type="text" class="form-control" name="tp_ketua" id="ketua" placeholder="KETUA" required/>
<label for="ketua">KETUA</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_khotbah" id="khotbah" placeholder="KHOTBAH" required/>
<label for="khotbah">KHOTBAH</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_menggali" id="menggali" placeholder="MENGGALI" required/>
<label for="menggali">MENGGALI</label>
</div></div>

<div class="col-sm-6">
<div class="form-label-group">
<input type="text" class="form-control" name="tp_bagian1" id="bagian1" placeholder="BAGIAN 1" required/>
<label for="bagian1">BAGIAN 1</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_bagian2" id="bagian2" placeholder="BAGIAN 2" required/>
<label for="bagian2">BAGIAN 2</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_pas" id="pas" placeholder="PAS" required/>
<label for="pas">PAS</label>
</div></div></div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_doatutup" id="doatutup" placeholder="DOA TUTUP" required/>
<label for="doatutup">DOA TUTUP</label>

</div>

<div class="row">
<div class="col-sm-6">
<div class="form-label-group">
<input type="text" class="form-control" name="tp_tavis1" id="tavis1" placeholder="TATA VISUAL 1" required/>
<label for="tavis1">TATA VISUAL 1</label>
</div>
</div>
<div class="col-sm-6">
<div class="form-label-group">
<input type="text" class="form-control" name="tp_tavis2" id="tavis2" placeholder="TATA VISUAL 2" required/>
<label for="tavis2">TATA VISUAL 2</label>
</div>
</div>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="tp_tatib" id="tatib" placeholder="TATA TERTIB" required/>
<label for="tatib">TATA TERTIB</label>
</div>
<div class="form-label-group">
<input type="text" class="form-control" name="tp_kebersihan" id="kebersihan" placeholder="KEBERSIHAN" required/>
<label for="kebersihan">KEBERSIHAN</label>
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
