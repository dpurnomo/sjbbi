<?php 
	$u = $_GET['u'];
	$s = $_GET['s'];
	$platform = $_GET['platform'];
	$m = $_GET['m'];
	$manufacturer = $_GET['manufacturer'];
$nav_id = 1;
$page = 'index.php';
include_once ('includes/secure.php');

// If no firstname, redirect user to complete his profile first
if(!isset($_SESSION['firstname']) || empty($_SESSION['firstname'])){
  header("location: profile.php?username=".$_SESSION['username']);
  exit;
}

$alertid = $_GET['a'];
?>

<!DOCTYPE html>
<html>

<head>
	<?php include_once('includes/header.php'); ?>
	<title>SJBBI</title>

</head>

<body class="text-center grad-royal">
	<?php 
include_once('includes/navbar.php');
?>
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title" style="margin-bottom:0px;"><i class="fas fa-user-circle"></i> TUGAS SAYA</h3>
						<p style="font-size:10px;"><strong>Info:<?php //print_r($_SESSION); ?></strong> Fitur ini baru berjalan kalau Saudara mengisi nama depan dan belakang di <a href="profile.php">profil</a> dengan tepat.</p>
						<p>
							<?php include_once('includes/dbconfig.php');
		$fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];		
		$sql = "Select * from Meetings where Concat(ap_ketua, '', ap_ku, '', ap_penerjemah, '' , ap_mp, '', ap_tavis1, '', ap_tavis2, '', ap_tatib, '', ap_pdl,'',tp_ketua,'',tp_khotbah,'',tp_menggali,'',tp_bagian1,'',tp_bagian2,'',tp_pas,'',tp_doatutup,'',tp_tavis1,'',tp_tavis2,'',tp_tatib, '' , pdl0, '', pdl1, '', pdl2, '', pdl3) like '%$fullname%' AND date >= CURDATE() ORDER BY date";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Perhimpunan</th><th>Tanggal</th><th>Tugas</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$assignment="";
		        $date = date_create($row["date"]);
		        if ($row['type']=="Akhir Pekan") { //Catch akhir pekan
		        	if ($row['ap_ketua'] == $fullname){$assignment = 'Ketua';}
		        	if ($row['ap_ku'] == $fullname){if(empty($assignment)){$assignment = 'KU';} else {$assignment .= ', KU';}}
		        	if ($row['ap_penerjemah'] == $fullname){if(empty($assignment)){$assignment = 'Penerjemah';} else {$assignment .= ', Penerjemah';}}        	
		        	if ($row['ap_mp'] == $fullname){if(empty($assignment)){$assignment = 'MP';} else {$assignment .= ', MP';}}
		        	if ($row['ap_tavis1'] == $fullname){if(empty($assignment)){$assignment = 'Tavis';} else {$assignment .= ', Tavis';}}
		        	if ($row['ap_tavis2'] == $fullname){if(empty($assignment)){$assignment = 'Tavis';} else {$assignment .= ', Tavis';}}
		        	if ($row['ap_tatib'] == $fullname){if(empty($assignment)){$assignment = 'Tatib';} else {$assignment .= ', Tatib';}}
		        	if ($row['ap_pdl'] == $fullname){if(empty($assignment)){$assignment = 'PDL';} else {$assignment .= ', PDL';}}
		        	echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m')."</td><td>".$assignment."</tr>";
		        }
		        if ($row['type']=="Tengah Pekan") { //Catch tengah pekan
		        	if ($row['tp_ketua'] == $fullname){$assignment = 'Ketua';}
		        	if ($row['tp_khotbah'] == $fullname){if(empty($assignment)){$assignment = 'Khotbah';} else {$assignment .= ', Khotbah';}}
		        	if ($row['tp_menggali'] == $fullname){if(empty($assignment)){$assignment = 'Menggali';} else {$assignment .= ', Menggali';}}        	
		        	if ($row['tp_bagian1'] == $fullname){if(empty($assignment)){$assignment = 'Bagian 1';} else {$assignment .= ', Bagian 1';}}
		        	if ($row['tp_bagian2'] == $fullname){if(empty($assignment)){$assignment = 'Bagian 2';} else {$assignment .= ', Bagian 2';}}
		        	if ($row['tp_pas'] == $fullname){if(empty($assignment)){$assignment = 'PAS';} else {$assignment .= ', PAS';}}
		        	if ($row['tp_doatutup'] == $fullname){if(empty($assignment)){$assignment = 'Doa Tutup';} else {$assignment .= ', Doa Tutup';}}
		        	if ($row['tp_tavis1'] == $fullname){if(empty($assignment)){$assignment = 'Tavis';} else {$assignment .= ', Tavis';}}
		        	if ($row['tp_tavis2'] == $fullname){if(empty($assignment)){$assignment = 'Tavis';} else {$assignment .= ', Tavis';}}
		        	if ($row['tp_tatib'] == $fullname){if(empty($assignment)){$assignment = 'Tatib';} else {$assignment .= ', Tatib';}}

		        	echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m')."</td><td>".$assignment."</tr>";
		        }
		        if ($row['type']=="PDL (Gabungan)") { //Catch PDL
					$assignment = "Pemandu PDL";
					echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m')."</td><td>".$assignment."</tr>";
					}
		        if ($row['type']=="PDL (KDL)") { //Catch PDL
					$assignment = "Pemandu PDL";
					echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m')."</td><td>".$assignment."</tr>";
					}
		    }
		    echo "</table></center></div>";
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-5">
				<!-----------=========================================================------>
				<div class="card">
					<div class="card-body">

						<h3 class="card-title" style="margin-bottom:0px;"><i class="far fa-calendar-alt"></i> KALENDER</h3>
						<p style="font-size:10px;">4 kegiatan ke depan. <a href="meeting.php">Lihat jadwal lengkap.</a></p>
						<?php include_once('includes/dbconfig.php');

		$sql = "SELECT id, type, date FROM Meetings WHERE date >= CURDATE() ORDER BY date LIMIT 4";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Kegiatan</th><th>Tanggal</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $date = date_create($row["date"]);
		        echo "<tr><td><a href='./meeting_show.php?id=". $row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m/y')."</td></tr>";
		    }
		    echo "</table></center></div>";
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
					</div>
				</div>


				<div class="card">
					<div class="card-body">
						<h3 class="card-title text-center mb-0"><i class="fas fa-plane faa-float animated"></i> Away</a>
						</h3>
						<p style="font-size:10px;" class="mb-1">60 hari ke depan.</p>
						<?php include_once('includes/dbconfig.php');
		$sql = "SELECT * FROM away WHERE enddate >= CURDATE() AND startdate <= DATE_ADD(CURDATE(),INTERVAL 60 DAY)  ORDER BY startdate";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Tanggal</th><th>Nama</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $startdate = date_create($row["startdate"]);
		        $enddate = date_create($row["enddate"]);
		        echo "<tr><td>".date_format($startdate, 'd/m')."-".date_format($enddate, 'd/m')."</td><td><a href='./person_awayshow.php?id=".$row["id"]."&p=".$page."'>".$row['person']."</a></td></tr>";
		    }
		    echo "</table>";
			 echo '<p style="margin-top:1em;"><a href="person_away.php?p='.$page.'" class="btn btn-primary">+</a></p></center></div>';
		} else {
		    echo "0 results";
		}
		?>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php include_once('includes/footer.php'); ?>
</body>

</html>
