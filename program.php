<?php 
$nav_id = 7;
$page = "program.php";
include_once ('includes/secure.php');
// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/header.php'); ?>
		<title>Program - SJBBI</title>
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
			<h3 class="card-title"><i class="far fa-calendar-alt"></i> Kebutuhan Setempat</h3>
			<?php include_once('includes/dbconfig.php');
//				$sql = "SELECT id, type, date FROM Meetings WHERE date >= CURDATE() ORDER BY date";
				$sql = 'SELECT id, type, date FROM Meetings WHERE RIGHT(type,5)="Pekan" AND date >= CURDATE() ORDER BY date';
				$result = $conn->query($sql);
		
				if ($result->num_rows > 0) {
				echo "<div><center><table><tr><th>Kegiatan</th><th>Tanggal</th></tr>";
				// output data of each row
				while($row = $result->fetch_assoc()) {
		        	$date = date_create($row["date"]);
					echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m/y')."</td></tr>";
		    	}
				echo "</table></center></div>";
				} else {
				echo "0 results";
				}
		?>
		<?php if($_SESSION['admin'] == 1){echo '<br><a href="meeting_tp-form.php" class="btn btn-primary">+TP</a> <a href="meeting_ap-form.php" class="btn btn-primary">+AP</a> <a href="meeting_other-form.php" class="btn btn-primary">+DLL</a>';}
		?>
  </div>
</div>
		</div>
<div class="col">
<!-----------=========================================================------>
	<div class="card">
		<div class="card-body">
		<h3 class="card-title"><i class="fas fa-calendar-alt"></i> LAIN-LAIN</h3>
		<p><?php include_once('includes/dbconfig.php');
$sql = 'SELECT id, type, date FROM Meetings WHERE (LEFT(type,9)="Kebaktian" OR type="WKP" OR type="Peringatan") AND date >= CURDATE() ORDER BY date';
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div><center><table><tr><th>Kegiatan</th><th>Tanggal</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $date = date_create($row["date"]);
		        echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m/y')."</td></tr>";
		    }
		    echo "</table></center></div>";
		} else {
		    echo '<i class="far fa-star" style="color:lightgrey;font-size:5em;"></i>';
		}
		?></p>
		</div>
		</div>

	<div class="card">
		<div class="card-body">
		<h3 class="card-title"><i class="fas fa-calendar-alt"></i> PDL</h3>
		<p><?php include_once('includes/dbconfig.php');
$sql = 'SELECT id, type, date FROM Meetings WHERE LEFT(type,3)="PDL" AND date >= CURDATE() ORDER BY date';
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    echo "<div><center><table><tr><th>Kegiatan</th><th>Tanggal</th></tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $date = date_create($row["date"]);
		        echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m/y')."</td></tr>";
		    }
		    echo "</table></center></div>";
		} else {
		    echo '<i class="far fa-star" style="color:lightgrey;font-size:5em;"></i>';
		}
		?></p>
		</div>
		</div>
		<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  RIWAYAT
</button>
		</div> <!-- col -->
	</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header text-center">
        <h4 class="modal-title text-center"><i class="fas fa-calendar-alt"></i> RIWAYAT LEWAT</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
			<p><?php include_once('includes/dbconfig.php');
	$sql = 'SELECT id, type, date FROM Meetings WHERE date < CURDATE() ORDER BY date';
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			    echo "<div><center><table><tr><th>Kegiatan</th><th>Tanggal</th></tr>";
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        $date = date_create($row["date"]);
			        echo "<tr><td><a href='./meeting_show.php?id=".$row["id"]."&p=".$page."'>".$row["type"]."</a></td><td>".date_format($date, 'D, d/m/y')."</td></tr>";
			    }
			    echo "</table></center></div>";
			} else {
			    echo '<i class="far fa-star" style="color:lightgrey;font-size:5em;"></i>';
			}
			$conn->close();
			?></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- The Modal end-->
		
		<?php include_once('includes/footer.php'); ?>
	</body>
</html>
