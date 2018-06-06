<?php
$id = $_GET['id'];
$origin = $_GET['p'];  
$page = "meeting_show.php?id=" . $id;
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
    header("location: meeting_show.php?id=" . $id);
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
		<title>Kalender - SJBBI</title>
<?php include_once('includes/header.php'); ?>		
<style>
pre {font-family: "Helvetica";font-size: 1em;}
p {margin-bottom: 3px;}

h6 {margin-top: 12px; margin-bottom: 6px; color: blue;}

.speaker {
color: DarkBlue;
margin-top: 0.75em;
font-weight: bold;
}
.speaker::before {
	color: DarkBlue;
	font-family: "Font Awesome 5 Free";
	font-weight: 900;
	content: "\f007\00a0";
}

.tugas {
color: Purple;
margin-top:0.75em;
font-weight: bold;
}
.tugas::before {
	color: Purple;
	font-family: "Font Awesome 5 Free";
	font-weight: 900;
	content: "\f007\00a0";
}
</style>	
</head>
	<body class="grad-royal">
<?php include_once('includes/navbar.php'); ?>
<div class="container-fluid">
<div class="row">
<div class="col-lg">
<div class="card mx-auto">
<div class="card-body">
<?php
include_once('includes/dbconfig.php');
$sql = "SELECT * FROM Meetings WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<center>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$type = $row["type"];
		$sqldate = $row["date"];
    	$date = date_create($row["date"]);
		$location = $row["location"];
		$notes = $row["notes"];
		switch($type){
			case "Tengah Pekan":
				//Variables
				$tp_pengumuman =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_pengumuman']); 
				$tp_khotbah_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_khotbah_bahan']); 
				$tp_menggali_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_menggali_bahan']); 
				$tp_bagian1_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_bagian1_bahan']); 
				$tp_bagian2_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row['tp_bagian2_bahan']); 
				$tp_pengumuman1 = $row["tp_pengumuman"];
				$tp_bagian1 = $row["tp_bagian1"];
				$tp_kebsetempat_is = $row["tp_kebsetempat_is"];
				$tp_kebsetempat = $row["tp_kebsetempat"];
				$tp_pembacaan = $row["tp_pembacaan"];
				$tp_tugas1 = $row["tp_tugas1"];
				$tp_tugas2 = $row["tp_tugas2"];
				$tp_tugas3 = $row["tp_tugas3"];
				if(!empty($row["tp_tugas1_partner"])){$tp_tugas1_partner = " & " . $row["tp_tugas1_partner"] ;} else {$tp_tugas1_partner ="";}
			 	if(!empty($row["tp_tugas2_partner"])){$tp_tugas2_partner = " & " . $row["tp_tugas2_partner"] ;} else {$tp_tugas2_partner ="";}
			 	if(!empty($row["tp_tugas3_partner"])){$tp_tugas3_partner = " & " . $row["tp_tugas3_partner"] ;} else {$tp_tugas3_partner ="";}


			echo "<h3>Perhimpunan Tengah Pekan</h3>";
			echo '<p>'.date_format($date, 'l, j F Y').'</p>';
			echo '<div class="text-left">';
			echo '<div class="text-right"><button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" 
			data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
   All <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></button></div>';
			echo '<h4>'.$row["tp_alkitab"].'</h4>';
			echo '<p class="speaker">Ketua: ' . $row["tp_ketua"];
			echo '</p><p>Nyanyian: '.$row["tp_lagu1"] . ' dan Doa</p>';
			echo '<p>Bagian Pembuka: (3 men. atau kurang)</p>';
			echo '<div style="background:darkslategrey; padding:3px; color:white;" class="mt-2 mb-2"><h4 class="mb-0" style="font-weight:normal;margin-left:1em;">HARTA DALAM FIRMAN ALLAH</h4></div>';
			echo '<p class="speaker">Khotbah: ' . $row["tp_khotbah"] .' <a class="badge badge-secondary" data-toggle="collapse" href="#collapsekhotbah" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></a></h5></p><div class="collapse multi-collapse" id="collapsekhotbah">'. $tp_khotbah_bahan.'</div>';
			echo '<p class="speaker">Menggali: '. $row["tp_menggali"] .' <a class="badge badge-secondary" data-toggle="collapse" href="#collapsemenggali" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></a></h5></p><div class="collapse multi-collapse" id="collapsemenggali">'. $tp_menggali_bahan.'</div>';
			echo '<p class="tugas">Pembacaan Alkitab: (4 men. atau kurang)<br><span style="color:black;">'. $row["tp_pembacaan"] . '</span></p><i>Nasihat: ' . $row["tp_pembacaan_no"] . ', Bahan: '.$row["tp_pembacaan_bahan"].'</i>';
			echo '<div style="background:goldenrod; padding:3px;color:white;" class="mt-2 mb-2"><h4 class="mb-0" style="font-weight:normal;margin-left:1em;">BERSEMANGATLAH DALAM PELAYANAN</h4></div>';
			echo '<p class="tugas">Tugas 1: ' . $row["tp_tugas1_tipe"] . '<br><span style="color:black;">' . $tp_tugas1 . $tp_tugas1_partner . '</span></p><i>Nasihat: ' . $row["tp_tugas1_no"] . ', Bahan: '.$row["tp_tugas1_bahan"].'</i>';
			echo '<p class="tugas">Tugas 2: ' . $row["tp_tugas2_tipe"] . '<br><span style="color:black;">' . $tp_tugas2 . $tp_tugas2_partner . '</span></p>Nasihat: ' . $row["tp_tugas2_no"] . ', Bahan: '.$row["tp_tugas2_bahan"];
			echo '<p class="tugas">Tugas 3: ' . $row["tp_tugas3_tipe"] . '<br><span style="color:black;">' . $tp_tugas3 . $tp_tugas3_partner . '</span></p>Nasihat: ' . $row["tp_tugas3_no"] . ', Bahan: '.$row["tp_tugas3_bahan"];
			echo '<div style="background:firebrick; padding:3px;color:white;" class="mt-2 mb-2"><h4 class="mb-0" style="font-weight:normal;margin-left:1em;">KEHIDUPAN KRISTEN</h4></div>';
			echo '<p>Nyanyian ' . $row['tp_lagu2'].'</p>';
			echo '<p class="speaker">Bagian 1: ' . $row["tp_bagian1"] .' <a class="badge badge-secondary" data-toggle="collapse" href="#collapsebagian1" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></a></h5></p><div class="collapse multi-collapse" id="collapsebagian1">'. $tp_bagian1_bahan.'</div>';
			echo '<p class="speaker">Bagian 2: ' . $row["tp_bagian2"] .' <a class="badge badge-secondary" data-toggle="collapse" href="#collapsebagian2" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></a></h5></p><div class="collapse multi-collapse" id="collapsebagian2">'. $tp_bagian2_bahan.'</div>';
			echo '<p class="speaker">PAS: (30 men.) ' . $row["tp_pas"] ." (". $row["tp_pas_bahan"] . ')';
			echo '</p><p>Tinjauan Hari ini dan Minggu Depan (3 men.)</p>';
			echo '<p>Nyanyian ' . $row['tp_lagu3'] . ' dan Doa Penutup ('. $row['tp_doatutup'].')</p>';
			echo '<br>';
			echo '<p><b><i class="fas fa-video"></i> Tata Visual: </b>'.$row["tp_tavis1"].' & '.$row["tp_tavis2"].'</p>';
			echo '<p><b><i class="fas fa-user-secret"></i> Tata Tertib: </b>'.$row["tp_tatib"].'</p>';
			echo '<p><b><i class="fas fa-shower"></i> Kebersihan: </b>'.$row["tp_kebersihan"].'</p>';


$sql2 = "SELECT * FROM Meetings WHERE date > '$sqldate' AND type='Tengah Pekan' LIMIT 1";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
		$date2 = date_create($row2["date"]);
				$tp_khotbah_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row2['tp_khotbah_bahan']); 
				$tp_menggali_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row2['tp_menggali_bahan']); 
				$tp_bagian1_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row2['tp_bagian1_bahan']); 
				$tp_bagian2_bahan =  Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->text($row2['tp_bagian2_bahan']); 


		echo '<br><hr><h5>Perhimpunan Berikut: <a href="meeting_show.php?id='.$row2["id"].'">' .date_format($date2, 'l, j F Y').'</a> 
		<a class="badge badge-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-list"></i> <i class="fas fa-arrow-down"></i></a></h5>';
			echo '<div class="collapse multi-collapse" id="collapseExample">';
		echo '<h5>Bahan</h5>';
		echo '<h6>Alkitab: </h6>' . $row2["tp_alkitab"];
		echo '<h6>Khotbah: </h6>' . $tp_khotbah_bahan;
		echo '<h6>Menggali: </h6>' . $tp_menggali_bahan;
		echo '<h6>Bagian 1: </h6>' . $tp_bagian1_bahan;
		echo '<h6>Bagian 2: </h6>' . $tp_bagian2_bahan;
		echo '<h6>PAS: </h6>' . $row2["tp_pas_bahan"];
		echo '<br><h5>Tugas Siswa</h5>';
		echo '<p>Pembacaan: ' . $row2["tp_pembacaan"].'</p>';
		echo '<p>Tugas 1: ' . $row2["tp_tugas1"].'</p>';
		echo '<p>Tugas 2: ' . $row2["tp_tugas2"].'</p>';
		echo '<p>Tugas 3: ' . $row2["tp_tugas3"].'</p></div>';
}
} 

			echo '</div>';

/*			echo '<table><tr><th>Tugas</th><th>Dibawakan Oleh</th></tr>';
			echo '<tr><td>Ketua</td><td>'.$row["tp_ketua"].'</td></tr>';
			echo '<tr><td>Khotbah</td><td>'.$row["tp_khotbah"].'</td></tr>';
			echo '<tr><td>Menggali</td><td>'.$row["tp_menggali"].'</td></tr>';	
			echo '<tr style="border-bottom: 2px solid #ddd;"><td>Pembacaan</td><td>'.$tp_pembacaan.'</td></tr>';	
			echo '<tr><td>Tugas 1 ('.$row["tp_tugas1_tipe"].')</td><td>'.$row["tp_tugas1"].$tp_tugas1_partner.'</td></tr>';
			echo '<tr><td>Tugas 2 ('.$row["tp_tugas2_tipe"].')</td><td>'.$row["tp_tugas2"].$tp_tugas2_partner.'</td></tr>';	
			echo '<tr style="border-bottom: 2px solid #ddd;"><td>Tugas 3 ('.$row["tp_tugas3_tipe"].')</td><td>'.$row["tp_tugas3"].$tp_tugas3_partner.'</td></tr>';	
			echo '<tr><td>Bagian 1</td><td>'.$row["tp_bagian1"].'</td></tr>';
			echo '<tr><td>Bagian 2</td><td>'.$row["tp_bagian2"].'</td></tr>';
			echo '<tr><td>PAS</td><td>'.$row["tp_pas"].'</td></tr>';
			echo '<tr style="border-bottom: 2px solid #ddd;"><td>Doa Tutup</td><td>'.$row["tp_doatutup"].'</td></tr>';		
			echo '<tr><td>Tata Visual</td><td>'.$row["tp_tavis1"].' & '.$row["tp_tavis2"].'</td></tr>';
			echo '<tr><td>Tata Tertib</td><td>'.$row["tp_tatib"].'</td></tr>';
			echo '<tr style="border-bottom: 2px solid #ddd;"><td>Kebersihan</td><td>'.$row["tp_kebersihan"].'</td></tr>';
			echo '</table>';
			echo "<br><br><center><p> <a href='./".$origin."' class='btn btn-primary'>Back</a>";
*/
			if ($_SESSION['admin']==1){
			echo "<a href='./meeting_tp-edit.php?id=". $id ."' class='btn btn-primary' style='margin-right:10px; margin-left:10px;'>Edit</a> <a href='./meeting_processdelete.php?id=". $id ."' class='btn btn-danger'>Delete</a>";
			}
    		break;
			case "Akhir Pekan":
			$ap_ku = $row["ap_ku"];
			$ap_ku_sidang = $row["ap_ku_sidang"];
			$ap_ku_rangka = $row["ap_ku_rangka"];
			$ap_ku_jamuan = $row["ap_ku_jamuan"];
			$ap_ku_tamu = $row["ap_ku_tamu"];
			$ap_ku_no = $row["ap_ku_no"];
			if ($ap_ku_tamu == 1){
			$tamulabel = " <sup style='color:green;'>TAMU</sup>";
			}
			echo "<h3>Perhimpunan Akhir Pekan</h3>";
			echo '<p>'.date_format($date, 'l, j F Y').'</p>';
			echo '<table><tr><th>Tugas</th><th>Dibawakan Oleh</th></tr>';
			echo '<tr><td>Ketua</td><td>'.$row["ap_ketua"].'</td></tr>';
			echo '<tr><td>Khotbah Umum</td><td>'.$row["ap_ku"].$tamulabel.'</td></tr>';
			echo '<tr><td>Rangka</td><td>'.$ap_ku_rangka.'</td></tr>';
			echo '<tr><td>Penerjemah</td><td>'.$row["ap_penerjemah"].'</td></tr>';			
			echo '<tr style="border-bottom: 1px solid #ddd;"><td>Pemandu MP</td><td>'.$row["ap_mp"].'</td></tr>';
			echo '<tr><td>Tata Visual</td><td>'.$row["ap_tavis1"].' & '.$row["ap_tavis2"].'</td></tr>';
			echo '<tr><td>Tata Tertib</td><td>'.$row["ap_tatib"].'</td></tr>';
			echo '<tr style="border-bottom: 1px solid #ddd;"><td>Kebersihan</td><td>'.$row["ap_kebersihan"].'</td></tr>';
			echo '<tr><td>Pemandu PDL</td><td>'.$row["ap_pdl"].'</td></tr>';
			echo '</table>';
			echo '<br>';
			echo "<br><br><center><p> <a href='./".$origin."' class='btn btn-primary'>Back</a>";
			if ($_SESSION['admin']==1){
				echo "<a href='./meeting_ap-edit.php?id=". $id ."' class='btn btn-primary' style='margin-right:10px; margin-left:10px;'>Edit</a> <a href='./meeting_processdelete.php?id=". $id ."' class='btn btn-danger'>Delete</a>";
			}
			break;
case "PDL (Gabungan)":
			$pdl0 = $row['pdl0'];
			echo "<h3>PDL Gabungan</h3>";
			echo '<p>'.date_format($date, 'l, j F Y').'</p>';
			echo '<table><tr><th>Tugas</th><th>Dibawakan Oleh</th></tr>';
			echo '<tr><td>Pemandu PDL</td><td>'.$pdl0.'</td></tr>';
			echo '<tr style="border-bottom: 1px solid #ddd;"><td>Lokasi</td><td><pre>'.$location.'</pre></td></tr>'; 	
			echo '<tr><td>Catatan</td><td><pre>'.$notes.'</pre></td></tr>';
			echo '</table>';
			echo "<br><br><center><p> <a href='./".$origin."' class='btn btn-primary'>Back</a>";
			if ($_SESSION['admin']==1){
			echo "<a href='./meeting_other-edit.php?id=". $id ."' class='btn btn-primary' style='margin-right:10px; margin-left:10px;'>Edit</a> <a href='./meeting_processdelete.php?id=". $id ."&p=".$origin."' class='btn btn-danger'>Delete</a>";
			}
    		break;

case "PDL (KDL)":
			$pdl1 = $row['pdl1'];
			$pdl2 = $row['pdl2'];
			$pdl3 = $row['pdl3'];
			echo "<h3>PDL KDL</h3>";
			echo '<p>'.date_format($date, 'l, j F Y').'</p>';
			echo '<table><tr><th>Tugas</th><th>Dibawakan Oleh</th></tr>';
			echo '<tr><td>Pemandu PDL</td><td>'.$pdl1.'<br>'.$pdl2.'<br>'.$pdl3.'</td></tr>';
			echo '<tr style="border-bottom: 1px solid #ddd;"><td>Lokasi</td><td><pre>'.$location.'</pre></td></tr>'; 	
			echo '<tr><td>Catatan</td><td><pre>'.$notes.'</pre></td></tr>';
			echo '</table>';
			echo "<br><br><center><p> <a href='./".$origin."' class='btn btn-primary'>Back</a>";
			if ($_SESSION['admin']==1){
			echo "<a href='./meeting_other-edit.php?id=". $id ."' class='btn btn-primary' style='margin-right:10px; margin-left:10px;'>Edit</a> <a href='./meeting_processdelete.php?id=". $id ."&p=".$origin."' class='btn btn-danger'>Delete</a>";
			}
    		break;
case "Kebaktian Wilayah"||"Kebaktian Regional"||"Peringatan"||"WKP":
			echo "<h3>".$type."</h3>";
			echo '<p>'.date_format($date, 'l, j F Y').'</p>';
			echo '<table><tr><th>Tugas</th><th>Dibawakan Oleh</th></tr>';
			echo '<tr style="border-bottom: 1px solid #ddd;"><td>Lokasi</td><td><pre>'.$location.'</pre></td></tr>'; 	
			echo '<tr><td>Catatan</td><td><pre>'.$notes.'</pre></td></tr>';
			echo '</table>';
			echo "<br><br><center><p> <a href='./".$origin."' class='btn btn-primary'>Back</a>";
			if ($_SESSION['admin']==1){
			echo "<a href='./meeting_other-edit.php?id=". $id ."' class='btn btn-primary' style='margin-right:10px; margin-left:10px;'>Edit</a> <a href='./meeting_processdelete.php?id=". $id ."&p=".$origin."' class='btn btn-danger'>Delete</a>";
			}
    		break;
//  <option>Kebaktian Wilayah</option>
//      <option>Kebaktian Regional</option>
//      <option>Peringatan</option>
//      <option>WKP</option>

    default:
			echo "";
			break;
		}
}
   echo "</center>";
} else {
    echo "0 results";
}
echo "</p></center>"
?>
</div></div></div>

<?php if($type !="Tengah Pekan"){ echo "<!--";} ?>
<div class="col-lg-3">
<div class="card">
<div class="card-body">
<h4 class="card-title">Pengumuman</h4>
<p class="card-text"><?php echo $tp_pengumuman; ?>
</p>
<p class="card-link"><center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Edit
</button>
<a href="meeting_pengumumanshow.php?id=<?php echo $id; ?>" class="btn btn-primary">View</a>
</center>
</p>
</div>
</div>

	<?php if($tp_kebsetempat_is ==1){
echo '<div class="card">';
echo '<div class="card-body">';
echo '<h4 class="card-title">Kebutuhan Setempat</h4>';
echo '<div class="d-flex w-100 text-muted">'.$tp_bagian1.'</div>';
echo '<div class="d-flex w-100 text-left font-italic">'.$tp_kebsetempat.'</div>';
echo '</div></div>';
}
?>	

</div>

<!-- Modal form -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Pengumuman</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
	  		<div class="form-group">
				
    		<textarea class="form-control" id="exampleFormControlTextarea1" name="tp_pengumuman" rows="10" ><?php echo $tp_pengumuman1; ?></textarea>
  			</div>
  		<center> <input class="btn btn-primary" type="submit" value="submit"/></center>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal form -->
<?php if($type !="Tengah Pekan"){
echo "-->";} ?>

<?php 
if($ap_ku_tamu !=1){
echo "<!--";} ?>
<div class="col-lg-3">
<div class="card">
<div class="card-body">
<h4 class="card-title">Khotbah Tamu</h4>
<p class="card-text"><b>Pengkhotbah:</b><br><?php echo $ap_ku; ?></p>
<p class="card-text"><b>Sidang: </b><br><?php echo $ap_ku_sidang; ?></p>
<p class="card-text"><b>Nomor: </b><br><?php echo $ap_ku_no; ?></p>
<p class="card-text"><b>Jamuan Makan: </b><br><?php echo $ap_ku_jamuan; ?>
</p>
</div>
</div>
</div>
<?php if($ap_ku_tamu !=1){
echo "-->";} ?>


</div></div>
<?php include_once('includes/footer.php'); ?>
</body>
</html>



