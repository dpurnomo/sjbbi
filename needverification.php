<?php 
$page="needverification.php";

// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php?p=".$page);
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Verifikasi</title>
<?php include_once('includes/header.php'); ?>
<link href="css/floating-formlabel.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
</head>
<body class="grad-royal">
<div class="wrapper">
		<div class="card">
		<div class="card-body">
		<div class="text-center mb-4">
        <h1 "h3 mb-3 font-weight-normal"><i class="fas fa-users"></i> SJBBI</h1>
        <h4 class="card-title">Verifikasi dibutuhkan</h4>
			<p class="card-text">Demi keamanan, akun perlu diverifikasi oleh Admin. Hubungi Admin untuk meminta akses ke situs ini.</p>
			<p class="card-text"><a href="login.php">Login ulang</a> setelah mendapat konfirmasi kalau sudah diverifikasi.</p>
		</div> <!--text center div-->
</div> <!--card-body div-->
</div> <!--card div-->
</div> <!--wrapper div-->
<?php include_once('includes/footer.php'); ?>
</body>
</html>