<?php 
$nav_id = 4;
$page = "meeting_ku.php";
include_once ('includes/secure.php');
// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/header.php'); ?>
		<title>KU - SJBBI</title>
	</head>
	<body class="text-center grad-royal">
<?php 
include_once('includes/navbar.php');
?>
<div class="container">
		<div class="row">
		  <div class="col" style="margin-bottom:30px;">
<div class="card">
  <div class="card-body">
	<h3 class="card-title"><i class="far fa-calendar-alt"></i> KE DEPAN</h3>
		<?php include_once('includes/dbconfig.php');
		$sql = "SELECT * FROM Meetings WHERE date >= CURDATE() && type='Akhir Pekan' ORDER BY date";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div style='overflow-x:auto;'><center><table><tr><th>Tanggal</th><th>Rangka</th><th>Lagu</th><th>Pengkhotbah</th><th>Sidang</th><th>Tamu</th><th>Penerjemah</th><th>Jamuan</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $date = date_create($row["date"]);
					//variables
					if($row['ap_ku_tamu']==1){
						$nojamuan="";
						$tamu = '<i class="far fa-check-circle" style="color:green"></i>';
						$tamuformat = '>';
						$tamucontact = ' <a href="tg://msg?to='.$row["ap_ku_no"].'"><i class="fab fa-telegram"></i></a>';
						$tamuform = ' <a href="meeting_ku_form.php?id='.$row["id"].'" target="_blank"><i class="fas fa-envelope"></i></a>';
						if($row['ap_ku_jamuan']==""){
							$nojamuan='<span class="badge badge-warning">Belum Ada</span>';
						}
					} else {
						$tamu="";
						$tamuformat=" style='background-color: lightgray;'>";
						$nojamuan="";
						$tamuform = "";
						$tamucontact = '';}

		        echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".date_format($date, 'd/m/y')."</a></td><td>".$row['ap_ku_rangka']."</td><td>".$row['ap_lagu1']."</td><td>"
							.$row['ap_ku'].$tamucontact.$tamuform."</td><td".$tamuformat.$row['ap_ku_sidang']."</td><td class='text-center'".$tamuformat.$tamu."</td><td".$tamuformat.$row['ap_penerjemah']
							."</td><td".$tamuformat.$nojamuan.$row['ap_ku_jamuan']."</td></tr>";
		    }
		    echo "</table></center></div>";
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
		<?php if($_SESSION['admin'] == 1){echo '<br><a href="meeting_tp-form.php" class="btn btn-primary">+TP</a> <a href="meeting_ap-form.php" class="btn btn-primary">+AP</a>';}
		?>
  </div>
</div>
		</div>

		</div>
		<?php include_once('includes/footer.php'); ?>
	</body>
</html>
