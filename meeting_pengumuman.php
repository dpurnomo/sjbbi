<?php 
$nav_id = 5;
$page = "meeting_pengumuman.php";
include_once ('includes/secure.php');
include_once('includes/Parsedown.php');
// Extend cookie life time by an amount of your liking
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/header.php'); ?>
		<title>Pengumuman - SJBBI</title>
<style>

</style>	
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
		<h3 class="card-title"><i class="fas fa-bullhorn"></i> KE DEPAN</h3>
	</div>
				</div>
	<div class="card-columns">
		<?php include_once('includes/dbconfig.php');
		$sql = "SELECT * FROM Meetings WHERE date >= CURDATE() && type='Tengah Pekan' ORDER BY date";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
	      	$date = date_create($row["date"]);
				$id = $row["id"];
					$tp_pengumuman = Parsedown::instance()
   				->setBreaksEnabled(true) // enables automatic line breaks
   				->line($row['tp_pengumuman']); 
				echo '<div class="card"><div class="card-body"><b>'.date_format($date, 'j M y').'</b>';
				echo '<p class="card-text text-left">'.$tp_pengumuman.'</p>';
				echo '<p class="card-link text-right"><a href="meeting_pengumumanshow.php?id='.$id. '" class="card-link"> View</a></p></div></div>';
		    }
		echo "</div>";
		} else {
		    echo "0 results";
		}
//		$conn->close();
		?>
		<?php if($_SESSION['admin'] == 1){echo '<br><a href="meeting_tp-form.php" class="btn btn-primary">+TP</a> <a href="meeting_ap-form.php" class="btn btn-primary">+AP</a>';}
		?>
  </div>
</div>


		<?php include_once('includes/footer.php'); ?>
	</body>
</html>
