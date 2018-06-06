<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//get POST variables
	$password = $_POST['password'];
	$submission = $_POST['submission'];
	$bulan = $_POST['bulan'];
	$nama = $_POST['nama'];
	$penempatan = $_POST['penempatan'];
	$video = $_POST['video'];
	$jam = $_POST['jam'];
	$kk = $_POST['kk'];
	$par = $_POST['par'];
	$catatan = $_POST['catatan'];
	if (empty($submission)){
		if ($password != "sjbbi"){
			$errormessage = "Password salah";
		} else {
			$showmodal = 1;
		}
	} else {
		echo "Nama: " . $bulan;
		echo "Nama: " . $nama;
		echo "Penempatan: " . $penempatan;
		echo "Pemutaran Video: " . $video;
		echo "Jam Dinas: " . $jam;
		echo "Kunjungan Kembali: " . $kk;
		echo "PAR: " . $par;
		echo "Catatan: " . $catatan;
		exit;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SJBBI Laporan</title>
	<?php include_once('includes/header.php'); ?>
	<style type="text/css">
html,
body {
    height: 100%;
}

.container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

	</style>
<?php
if ($showmodal == 1){
echo '<!--Jquery to directly open the modal form-->';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
echo '<script type="text/javascript">';
echo '    $(document).ready(function(){';
echo '        $("#myModal").modal("show")';
echo    '});';
echo '</script>';
}
?>


</head>
<body class="grad-royal">


<div class="container">
  <div class="card text-center" style="padding-left:3em;padding-right:3em;">
  	<div class="card-body">
  		<h1 "h3 mb-3 font-weight-normal"><i class="fas fa-users"></i> SJBBI</h1>
  		<p>Masukkan password:</p>
  	<form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
    <input type="password" name="password">  
    <small id="emailHelp" class="form-text" style="color:red"><?= $errormessage ?></small>
  	<input type="submit" value="Submit" class="btn btn-primary mt-2">
  </form>
</div>
  </div>
</div>


<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-list"></i> Masukkan Laporan</a></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="hidden" name="submission" value="true">
		  	  <div class="form-group">
    			<label for="bulan">Bulan</label>
    			<select class="form-control" id="bulan" name="bulan" required>
			      <option value="201803">Maret 2018</option>
			      <option value="201804">April 2018</option>
			      <option value="201805">Mei 2018</option>
			      <option value="201806">Juni 2018</option>
			      <option value="201807">Juli 2018</option>
			    </select>
  			</div>

		  	<div class="form-group">
    		<label for="nama">Nama</label>
    		<input type="text" class="form-control" name="nama" id="nama" required>
  			</div>

			<div class="form-group">
    		<label for="penempatan">Penempatan</label>
    		<input type="number" class="form-control" name="penempatan" id="penempatan" placeholder="Penempatan">
  			</div>

			<div class="form-group">
    		<label for="video">Pemutaran Video</label>
    		<input type="number" class="form-control" name="video" id="video" placeholder="Pemutaran Video">
  			</div>

			<div class="form-group">
    		<label for="jam">Jam Dinas</label>
    		<input type="number" class="form-control" name="jam" id="jam" placeholder="Jam Dinas">
  			</div>

			<div class="form-group">
    		<label for="kk">Kunjungan Kembali</label>
    		<input type="number" class="form-control" name="kk" id="kk" placeholder="Kunjungan Kembali">
  			</div>

			<div class="form-group">
    		<label for="par">PAR</label>
    		<input type="number" class="form-control" name="par" id="par" placeholder="PAR">
  			</div>

			<div class="form-group">
			Catatan:
    		<textarea class="form-control" id="catatan" name="catatan" rows="5" ></textarea>
  			</div>
  		<div class="text-center">
			<input class="btn btn-primary" type="submit" value="Save"/>
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