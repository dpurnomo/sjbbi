<?php
$page = "meeting_ap-edit.php";
include_once('includes/secure.php'); // protected page
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
$createdby = $_SESSION['username'];
$modifiedby = $_SESSION['username'];
$date = $_POST['date'];  
$ap_ketua = trim($_POST['ap_ketua']);  
$ap_ku = trim($_POST['ap_ku']);
$ap_ku_no = trim($_POST['ap_ku_no']); 
$ap_penerjemah = trim($_POST['ap_penerjemah']); 
$ap_mp = trim($_POST['ap_mp']);
$ap_tavis1 = trim($_POST['ap_tavis1']);
$ap_tavis2 = trim($_POST['ap_tavis2']);
$ap_tatib = trim($_POST['ap_tatib']);
$ap_kebersihan = trim($_POST['ap_kebersihan']);
$ap_pdl = trim($_POST['ap_pdl']);
$ap_ku_rangka = trim($_POST['ap_ku_rangka']); 
$ap_ku_sidang = trim($_POST['ap_ku_sidang']); 
if (empty($_POST['ap_ku_tamu'])){
$ap_ku_tamu = 0; 
} else {
$ap_ku_tamu = trim($_POST['ap_ku_tamu']); 
}

$ap_ku_jamuan = trim($_POST['ap_ku_jamuan']); 

$sql = "UPDATE Meetings SET date='$date', ap_ketua='$ap_ketua', ap_ku='$ap_ku', ap_penerjemah='$ap_penerjemah', ap_mp='$ap_mp',ap_tavis1='$ap_tavis1',ap_tavis2='$ap_tavis2',ap_tatib='$ap_tatib',ap_kebersihan='$ap_kebersihan', ap_pdl='$ap_pdl',ap_ku_rangka='$ap_ku_rangka',ap_ku_tamu='$ap_ku_tamu',ap_ku_sidang='$ap_ku_sidang',ap_ku_jamuan='$ap_ku_jamuan',ap_ku_no='$ap_ku_no', modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: meeting_ap-edit.php?id=" . $id);
//echo "$id is: " . $id;
//	echo $sql;
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
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {	     
	$date = $row["date"];
		if ($row["type"]=="Akhir Pekan"){
			$ketua = $row["ap_ketua"];
			$ku = $row["ap_ku"];
			$ap_ku_no = $row["ap_ku_no"];
			$penerjemah = $row["ap_penerjemah"];
			$rangka = $row["ap_ku_rangka"];
			$mp = $row["ap_mp"];
			$tavis1 = $row["ap_tavis1"];
			$tavis2 = $row["ap_tavis2"];
			$tatib = $row["ap_tatib"];
			$kebersihan = $row["ap_kebersihan"];
			$pdl = $row["ap_pdl"];
			$tamu = $row["ap_ku_tamu"];
			$sidang = $row["ap_ku_sidang"];
			$jamuan = $row["ap_ku_jamuan"];
    	}
    } 
} else {

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('includes/header.php'); ?>
    <title>AP - SJBBI</title>
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
	<h1 style="margin-bottom:0px;">Perhimpunan Akhir Pekan</h1>
	<?php echo "<p style='font-size:10px;'>ID #".$id."</p>"?>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<div class="row">
<div class="col-lg-6">
<div class="form-label-group">
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:3em;" value="<?php echo $date ?>"/>
<label for="date">TANGGAL</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_ketua" id="ketua" placeholder="KETUA" value="<?php echo $ketua ?>"/>
<label for="ketua">KETUA</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_ku" id="ku" placeholder="KHOTBAH UMUM" value="<?php echo $ku ?>"/>
<label for="ku">KHOTBAH UMUM</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_ku_rangka" id="rangka" placeholder="RANGKA" value="<?php echo $rangka ?>"/>
<label for="rangka">RANGKA</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_penerjemah" id="penerjemah" placeholder="PENERJEMAH" value="<?php echo $penerjemah ?>"/>
<label for="penerjemah">PENERJEMAH</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_mp" id="mp" placeholder="PEMANDU MP" value="<?php echo $mp ?>"/>
<label for="mp">PEMANDU MP</label>
</div>
</div><div class="col-lg-6">
<div class="form-label-group">
<input type="text" class="form-control" name="ap_tavis1" id="tavis1" placeholder="TATA VISUAL 1" value="<?php echo $tavis1 ?>"/>
<label for="tavis1">TATA VISUAL 1</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_tavis2" id="tavis2" placeholder="TATA VISUAL 2" value="<?php echo $tavis2 ?>"/>
<label for="tavis2">TATA VISUAL 2</label>
</div>

<div class="form-label-group">
<input type="text" class="form-control" name="ap_tatib" id="tatib" placeholder="TATA TERTIB" value="<?php echo $tatib ?>"/>
<label for="tatib">TATA TERTIB</label>
</div>
<div class="form-label-group">
<input type="text" class="form-control" name="ap_kebersihan" id="kebersihan" placeholder="KEBERSIHAN" value="<?php echo $kebersihan ?>"/>
<label for="kebersihan">KEBERSIHAN</label>
</div>
<div class="form-label-group">
<input type="text" class="form-control" name="ap_pdl" id="pdl" placeholder="PEMANDU PDL" value="<?php echo $pdl ?>"/>
<label for="pdl">PEMANDU PDL</label>
</div>
</div></div>
<h4>KHOTBAH TAMU</h4>
<div class="checkbox">
<label><input type="checkbox" id="ap_ku_tamu" class="checkbox" name="ap_ku_tamu" value=1 <?php if($tamu==1){echo "checked";}?> > Tamu</label>
</div>
<div class="row">
<div class="col-md">
<div class="form-label-group">
<input type="text" name="ap_ku_sidang" class="form-control" id="sidang" placeholder="SIDANG" value="<?php echo $sidang ?>"/>
<label for="sidang">SIDANG</label>
</div>
<div class="form-label-group">
<input type="tel" name="ap_ku_no" class="form-control" id="ap_ku_no" placeholder="NOMOR TELEPON" value="<?php echo $ap_ku_no ?>"/>
<label for="ap_ku_no">NOMOR TELEPON</label>
</div>
</div>
<div class="col-md">
<div class="form-label-group">
<input type="text" name="ap_ku_jamuan" id="jamuan" class="form-control" placeholder="JAMUAN MAKAN" value="<?php echo $jamuan ?>"/>
<label for="jamuan">JAMUAN MAKAN</label>
</div>
</div>
</div>
</div>
</div></div>
<div class="text-center">
<input type="submit" class="btn btn-primary" value="Submit">
<a href="./meeting_show.php?id=<?php echo $id; ?>" class="btn btn-primary">Return</a>
</div>
</div>
</div>
</div>
</form>
<?php include_once('includes/footer.php'); ?>
</body>
</html>
