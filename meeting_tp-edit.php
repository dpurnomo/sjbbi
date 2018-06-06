<?php
include_once('includes/secure.php'); // protected page
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
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
$tp_kebsetempat = trim($_POST['tp_kebsetempat']);
if (empty($_POST['tp_kebsetempat_is'])){
$tp_kebsetempat_is = 0; 
} else {
$tp_kebsetempat_is = trim($_POST['tp_kebsetempat_is']); 
}

	$tp_alkitab = trim($_POST["tp_alkitab"]);
	$tp_lagu1 = trim($_POST["tp_lagu1"]);
	$tp_lagu2 = trim($_POST["tp_lagu2"]);
	$tp_lagu3 = trim($_POST["tp_lagu3"]);
	$tp_khotbah_bahan = trim($_POST["tp_khotbah_bahan"]);
	$tp_menggali_bahan = trim($_POST["tp_menggali_bahan"]);
	$tp_pembacaan_bahan = trim($_POST["tp_pembacaan_bahan"]);
  $tp_pembacaan_no = trim($_POST["tp_pembacaan_no"]);
	$tp_tugas1_bahan = trim($_POST["tp_tugas1_bahan"]);
	$tp_tugas1_tipe = trim($_POST["tp_tugas1_tipe"]);
  $tp_tugas1_no = trim($_POST["tp_tugas1_no"]);
	$tp_tugas2_bahan = trim($_POST["tp_tugas2_bahan"]);
	$tp_tugas2_tipe = trim($_POST["tp_tugas2_tipe"]);
  $tp_tugas2_no = trim($_POST["tp_tugas2_no"]);
	$tp_tugas3_bahan = trim($_POST["tp_tugas3_bahan"]);
	$tp_tugas3_tipe = trim($_POST["tp_tugas3_tipe"]);
  $tp_tugas3_no = trim($_POST["tp_tugas3_no"]);
	$tp_bagian1_bahan = trim($_POST["tp_bagian1_bahan"]);
	$tp_bagian2_bahan = trim($_POST["tp_bagian2_bahan"]);
	$tp_pas_bahan = trim($_POST["tp_pas_bahan"]);

	$tp_pembacaan = trim($_POST["tp_pembacaan"]);
	$tp_tugas1 = trim($_POST["tp_tugas1"]);
	$tp_tugas2 = trim($_POST["tp_tugas2"]);
	$tp_tugas3 = trim($_POST["tp_tugas3"]);
	$tp_tugas1_partner = trim($_POST["tp_tugas1_partner"]);
	$tp_tugas2_partner = trim($_POST["tp_tugas2_partner"]);
	$tp_tugas3_partner = trim($_POST["tp_tugas3_partner"]);
	

$sql = "UPDATE Meetings SET date='$date', tp_ketua='$tp_ketua', tp_khotbah='$tp_khotbah', 
tp_menggali='$tp_menggali', tp_bagian1='$tp_bagian1',tp_bagian2='$tp_bagian2',tp_pas='$tp_pas',
tp_doatutup='$tp_doatutup',tp_tavis1='$tp_tavis1',tp_tavis2='$tp_tavis2',tp_tatib='$tp_tatib',
tp_kebersihan='$tp_kebersihan', 
tp_kebsetempat='$tp_kebsetempat', tp_kebsetempat_is = '$tp_kebsetempat_is', 
tp_alkitab = '$tp_alkitab', tp_lagu1='$tp_lagu1', tp_lagu2 = '$tp_lagu2', tp_lagu3 = '$tp_lagu3',
tp_khotbah_bahan = '$tp_khotbah_bahan', tp_menggali_bahan = '$tp_menggali_bahan', 
tp_pembacaan_bahan = '$tp_pembacaan_bahan', tp_tugas1_bahan = '$tp_tugas1_bahan',
tp_tugas2_bahan = '$tp_tugas2_bahan', tp_tugas3_bahan = '$tp_tugas3_bahan',
tp_tugas1_tipe = '$tp_tugas1_tipe', tp_tugas2_tipe = '$tp_tugas2_tipe',
tp_tugas3_tipe = '$tp_tugas3_tipe', tp_bagian1_bahan = '$tp_bagian1_bahan',
tp_bagian2_bahan = '$tp_bagian2_bahan',tp_pas_bahan = '$tp_pas_bahan',
tp_pembacaan_no = '$tp_pembacaan_no', tp_tugas1_no = '$tp_tugas1_no', tp_tugas2_no = '$tp_tugas2_no', tp_tugas3_no = '$tp_tugas3_no',
tp_pembacaan = '$tp_pembacaan', tp_tugas1 = '$tp_tugas1', tp_tugas2 = '$tp_tugas2',
tp_tugas3 = '$tp_tugas3',tp_tugas1_partner = '$tp_tugas1_partner',
tp_tugas2_partner = '$tp_tugas2_partner',tp_tugas3_partner = '$tp_tugas3_partner',
modifiedby='$modifiedby', modifieddate=now() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: meeting_show.php?id=" . $id);
//echo "$id is: " . $id;
//	echo $sql;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>

<?php
//Populate form
$id = $_GET['id'];  
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM Meetings WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {	     
	$date = $row["date"];
	$tp_ketua = $row["tp_ketua"];
	$tp_khotbah = $row["tp_khotbah"];
	$tp_menggali = $row["tp_menggali"];
	$tp_bagian1 = $row["tp_bagian1"]	;
	$tp_bagian2 = $row["tp_bagian2"];
	$tp_pas = $row["tp_pas"];
	$tp_doatutup = $row["tp_doatutup"];
	$tp_tavis1 = $row["tp_tavis1"];
	$tp_tavis2 = $row["tp_tavis2"];
	$tp_tatib = $row["tp_tatib"];
	$tp_kebersihan = $row["tp_kebersihan"];
	$tp_kebsetempat = $row["tp_kebsetempat"];
	$tp_kebsetempat_is = $row["tp_kebsetempat_is"];

	$tp_alkitab = $row["tp_alkitab"];
	$tp_lagu1 = $row["tp_lagu1"];
	$tp_lagu2 = $row["tp_lagu2"];
	$tp_lagu3 = $row["tp_lagu3"];
	$tp_khotbah_bahan = $row["tp_khotbah_bahan"];
	$tp_menggali_bahan = $row["tp_menggali_bahan"];
	$tp_pembacaan_bahan = $row["tp_pembacaan_bahan"];
	$tp_tugas1_bahan = $row["tp_tugas1_bahan"];
	$tp_tugas1_tipe = $row["tp_tugas1_tipe"];
	$tp_tugas2_bahan = $row["tp_tugas2_bahan"];
	$tp_tugas2_tipe = $row["tp_tugas2_tipe"];
	$tp_tugas3_bahan = $row["tp_tugas3_bahan"];
	$tp_tugas3_tipe = $row["tp_tugas3_tipe"];
	$tp_bagian1_bahan = $row["tp_bagian1_bahan"];
	$tp_bagian2_bahan = $row["tp_bagian2_bahan"];
	$tp_pas_bahan = $row["tp_pas_bahan"];
	$tp_pembacaan = $row["tp_pembacaan"];
	$tp_tugas1 = $row["tp_tugas1"];
	$tp_tugas2 = $row["tp_tugas2"];
	$tp_tugas3 = $row["tp_tugas3"];
	$tp_pembacaan_no = $row["tp_pembacaan_no"];
	$tp_tugas1_no = $row["tp_tugas1_no"];
	$tp_tugas2_no = $row["tp_tugas2_no"];
	$tp_tugas3_no = $row["tp_tugas3_no"];
      
  $tp_tugas1_partner = $row["tp_tugas1_partner"];
	$tp_tugas2_partner = $row["tp_tugas2_partner"];
	$tp_tugas3_partner = $row["tp_tugas3_partner"];
    } 

} else {
    echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('includes/header.php'); ?>
    <title>TP - SJBBI</title>
<!-- <link href="css/floating-formlabel.css" rel="stylesheet"> -->
<style>
	label, input {text-align:left;}
</style>
</head>
<body class="grad-royal text-left" style="text-align:left;">
<?php include_once('includes/navbar.php'); ?>
<div class="container-fluid text-left">
<div class="card"><div class="card-body">
	<div class="text-center">
	<h1>Perhimpunan Tengah Pekan <?php echo "<small>ID #".$id."</small>"?></h1>
	</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="id" value="<?php echo $id ?>">

<div class="form-group">
<label for="date">TANGGAL</label>
<input id="date" type="date" class="form-control" placeholder="TANGGAL" name="date" style="height:2.5em;" value="<?php echo $date ?>" />
</div>


<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="ketua">KETUA</label>
<input type="text" class="form-control" name="tp_ketua" id="ketua" placeholder="KETUA" value="<?php echo $tp_ketua ?>" />
</div>

<div class="form-group">
<label for="khotbah">KHOTBAH</label>
<input type="text" class="form-control" name="tp_khotbah" id="khotbah" placeholder="KHOTBAH" value="<?php echo $tp_khotbah ?>"/>
</div>

<div class="form-group">
<label for="menggali">MENGGALI</label>
<input type="text" class="form-control" name="tp_menggali" id="menggali" placeholder="MENGGALI" value="<?php echo $tp_menggali ?>" />
</div></div>

<div class="col-sm-6">
<div class="form-group">
<label for="bagian1">BAGIAN 1</label>
<input type="text" class="form-control" name="tp_bagian1" id="bagian1" placeholder="BAGIAN 1" value="<?php echo $tp_bagian1 ?>"/>
</div>

<div class="form-group">
<label for="bagian2">BAGIAN 2</label>
<input type="text" class="form-control" name="tp_bagian2" id="bagian2" placeholder="BAGIAN 2" value="<?php echo $tp_bagian2 ?>"/>

</div>

<div class="form-group">
<label for="pas">PAS</label>
<input type="text" class="form-control" name="tp_pas" id="pas" placeholder="PAS" value="<?php echo $tp_pas ?>"/>
</div></div></div>

<div class="form-group">
<label for="doatutup">DOA TUTUP</label>
<input type="text" class="form-control" name="tp_doatutup" id="doatutup" placeholder="DOA TUTUP" value="<?php echo $tp_doatutup ?>"/>
</div>

<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="tavis1">TATA VISUAL 1</label>
<input type="text" class="form-control" name="tp_tavis1" id="tavis1" placeholder="TATA VISUAL 1" value="<?php echo $tp_tavis1 ?>"/>

</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label for="tavis2">TATA VISUAL 2</label>
<input type="text" class="form-control" name="tp_tavis2" id="tavis2" placeholder="TATA VISUAL 2" value="<?php echo $tp_tavis2 ?>"/>
</div>
</div>
</div>

<div class="form-group">
<label for="tatib">TATA TERTIB</label>
<input type="text" class="form-control" name="tp_tatib" id="tatib" placeholder="TATA TERTIB" value="<?php echo $tp_tatib ?>"/>

</div>
<div class="form-group">
<label for="kebersihan">KEBERSIHAN</label>
<input type="text" class="form-control" name="tp_kebersihan" id="kebersihan" placeholder="KEBERSIHAN" value="<?php echo $tp_kebersihan ?>"/>

</div>

<div class="checkbox">
<label><input type="checkbox" id="tp_kebsetempat_is" class="checkbox" name="tp_kebsetempat_is" value=1 <?php if($tp_kebsetempat_is==1){echo "checked";}?> > KEBUTUHAN SETEMPAT?</label>
</div>
	
<div class="form-group">
<label for="kebutuhansetempat">TOPIK KEBUTUHAN SETEMPAT</label>
<input type="text" class="form-control" name="tp_kebsetempat" id="kebutuhansetempat" placeholder="TOPIK KEBUTUHAN SETEMPAT" value="<?php echo $tp_kebsetempat ?>"/>
</div>

<h3>Tugas Siswa</h3>
<div class="form-group">
<label for="alkitab">PEMBACAAN</label>
<input type="text" class="form-control" name="tp_pembacaan" id="alkitab" placeholder="PEMBACAAN ALKITAB" value="<?php echo $tp_pembacaan ?>"/>
<input type="text" class="form-control" name="tp_pembacaan_no" id="alkitab" placeholder="NOMOR NASIHAT" value="<?php echo $tp_pembacaan_no ?>"/>
</div>

<div class="form-group">
<label for="alkitab">TUGAS 1</label>
<input type="text" class="form-control" name="tp_tugas1" id="alkitab" placeholder="TUGAS 1" value="<?php echo $tp_tugas1 ?>"/>
<input type="text" class="form-control" name="tp_tugas1_partner" id="alkitab" placeholder="TUGAS 1 Partner" value="<?php echo $tp_tugas1_partner ?>"/>
<input type="text" class="form-control" name="tp_tugas1_no" id="alkitab" placeholder="NOMOR NASIHAT" value="<?php echo $tp_tugas1_no ?>"/>
</div>
<div class="form-group">
<label for="alkitab">TUGAS 2</label>
<input type="text" class="form-control" name="tp_tugas2" id="alkitab" placeholder="TUGAS 2" value="<?php echo $tp_tugas2 ?>"/>
<input type="text" class="form-control" name="tp_tugas2_partner" id="alkitab" placeholder="TUGAS 2 Partner" value="<?php echo $tp_tugas2_partner ?>"/>
<input type="text" class="form-control" name="tp_tugas2_no" id="alkitab" placeholder="NOMOR NASIHAT" value="<?php echo $tp_tugas2_no ?>"/>
</div>
<div class="form-group">
<label for="alkitab">TUGAS 3</label>
<input type="text" class="form-control" name="tp_tugas3" id="alkitab" placeholder="TUGAS 3" value="<?php echo $tp_tugas3 ?>"/>
<input type="text" class="form-control" name="tp_tugas3_partner" id="alkitab" placeholder="TUGAS 3 Partner" value="<?php echo $tp_tugas3_partner ?>"/>
<input type="text" class="form-control" name="tp_tugas3_no" id="alkitab" placeholder="NOMOR NASIHAT" value="<?php echo $tp_tugas3_no ?>"/>
</div>




<h3>Bahan</h3>

<div class="form-group">
<label for="alkitab">ALKITAB</label>
<input type="text" class="form-control" name="tp_alkitab" id="alkitab" placeholder="ALKITAB" value="<?php echo $tp_alkitab ?>"/>
</div>

<div class="form-group">
<label for="lagu1">LAGU 1</label>
<input type="text" class="form-control" name="tp_lagu1" id="lagu1" placeholder="LAGU 1" value="<?php echo $tp_lagu1 ?>"/>
<label for="lagu2">LAGU 2</label>
<input type="text" class="form-control" name="tp_lagu2" id="lagu2" placeholder="LAGU 2" value="<?php echo $tp_lagu2 ?>"/>
<label for="lagu3">LAGU 3</label>
<input type="text" class="form-control" name="tp_lagu3" id="lagu3" placeholder="LAGU 3" value="<?php echo $tp_lagu3 ?>"/>
</div>
<div class="form-group">
<label for="alkitab">KHOTBAH</label>
<textarea class="form-control" name="tp_khotbah_bahan" rows="5" id="alkitab"><?php echo $tp_khotbah_bahan ?></textarea>
</div>

<div class="form-group">
<label for="alkitab">MENGGALI</label>
<textarea class="form-control" name="tp_menggali_bahan" rows="5" id="alkitab"><?php echo $tp_menggali_bahan ?></textarea>
</div>

<div class="form-group">
<label for="alkitab">PEMBACAAN</label>
<input type="text" class="form-control" name="tp_pembacaan_bahan" id="alkitab" placeholder="PEMBACAAN" value="<?php echo $tp_pembacaan_bahan ?>"/>
</div>

<div class="form-group">
<label for="alkitab">TUGAS 1</label>
<input type="text" class="form-control" name="tp_tugas1_bahan" id="alkitab" placeholder="Tugas 1 Bahan" value="<?php echo $tp_tugas1_bahan ?>"/>
<input type="text" class="form-control" name="tp_tugas1_tipe" id="alkitab" placeholder="Tugas 1 Tipe" value="<?php echo $tp_tugas1_tipe ?>"/>
</div>

<div class="form-group">
<label for="alkitab">TUGAS 2</label>
<input type="text" class="form-control" name="tp_tugas2_bahan" id="alkitab" placeholder="Tugas 2 Bahan" value="<?php echo $tp_tugas2_bahan ?>"/>
<input type="text" class="form-control" name="tp_tugas2_tipe" id="alkitab" placeholder="Tugas 2 Tipe" value="<?php echo $tp_tugas2_tipe ?>"/>
</div>

<div class="form-group">
<label for="alkitab">TUGAS 3</label>
<input type="text" class="form-control" name="tp_tugas3_bahan" id="alkitab" placeholder="Tugas 3 Bahan" value="<?php echo $tp_tugas3_bahan ?>"/>
<input type="text" class="form-control" name="tp_tugas3_tipe" id="alkitab" placeholder="Tugas 3 Tipe" value="<?php echo $tp_tugas3_tipe ?>"/>
</div>

<div class="form-group">
<label for="alkitab">BAGIAN 1</label>
<textarea class="form-control" name="tp_bagian1_bahan" rows="5" id="alkitab"><?php echo $tp_bagian1_bahan ?></textarea>
</div>
<div class="form-group">
<label for="alkitab">BAGIAN 2</label>
<textarea class="form-control" name="tp_bagian2_bahan" rows="5" id="alkitab"><?php echo $tp_bagian2_bahan ?></textarea>
</div>
<div class="form-group">
<label for="alkitab">PAS</label>
<input type="text" class="form-control" name="tp_pas_bahan" id="alkitab" placeholder="PAS" value="<?php echo $tp_pas_bahan ?>"/>
</div>

<div class="text-center">
<input type="submit" class="btn btn-primary" value="Submit">
<a href="./meeting.php" class="btn btn-primary">Return</a>
</div>

</div></div>
</div>
</form>
<?php include_once('includes/footer.php'); ?>
</body>
</html>
