<?php 
$nav_id = 9;
$page = "meeting_tugas-all.php";
include_once ('includes/secure.php');
// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/header.php'); ?>
		<title>Tugas Siswa - SJBBI</title>
	</head>
	<body class="text-left grad-royal">
<?php 
include_once('includes/navbar.php');
?>
<div class="container">
		<div class="row">
		  <div class="col" style="margin-bottom:30px;">
<div class="card">
  <div class="card-body">
	<h3 class="card-title"><i class="far fa-calendar-alt"></i> SEMUA <a href="meeting_tugas.php" class="btn btn-primary">SEJAK 1 BULAN LALU</a></h3>
		<?php include_once('includes/dbconfig.php');
		$sql = "SELECT * FROM Meetings WHERE type='Tengah Pekan' ORDER BY date";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
//		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Tanggal</th><th>Pembacaan</th><th>Nasihat</th><th>Pengkhotbah</th><th>Sidang</th><th>Tamu</th><th>Penerjemah</th><th>Jamuan</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $date = date_create($row["date"]);
					//variables
		        echo "<h4><a href='./meeting_tugas-edit.php?id=".$row["id"]."&p=".$page."'>".date_format($date, 'd/m/y')."</a> | Ketua: ".$row["tp_ketua"]."</h4>";
		        echo "<div style='overflow-x:auto;'><table><th>Tugas</th><th>Siswa</th><th>Partner</th><th>Nasihat</th><th>Nasihat Berikut/Catatan</th>";
		        echo "<tr><td>Pembacaan</td><td>".$row['tp_pembacaan']."</td><td></td><td>".$row['tp_pembacaan_no']."</td><td>".$row['tp_pembacaan_no2']."</td>";
		        echo "<tr><td>Tugas Siswa 1 -".$row['tp_tugas1_tipe']."</td><td>".$row['tp_tugas1']."</td><td>".$row['tp_tugas1_partner']."</td><td>".$row['tp_tugas1_no']."</td><td>".$row['tp_tugas1_no2']."</td>";
		        echo "<tr><td>Tugas Siswa 2 -".$row['tp_tugas2_tipe']."</td><td>".$row['tp_tugas2']."</td><td>".$row['tp_tugas2_partner']."</td><td>".$row['tp_tugas2_no']."</td><td>".$row['tp_tugas2_no2']."</td>";
		        echo "<tr><td>Tugas Siswa 3 -".$row['tp_tugas3_tipe']."</td><td>".$row['tp_tugas3']."</td><td>".$row['tp_tugas3_partner']."</td><td>".$row['tp_tugas3_no']."</td><td>".$row['tp_tugas3_no2']."</td>";
		        echo "</table></div><br>";
		 }       
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
  </div>
</div>
		</div>

		</div>
		<?php include_once('includes/footer.php'); ?>
	</body>
</html>
