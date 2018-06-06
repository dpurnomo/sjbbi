<?php
$page="profile.php";
include_once('includes/secure.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
	<?php include_once('includes/header.php'); ?>

</head>
<body class="grad-royal">
<?php
include_once('includes/dbconfig.php');
include_once('includes/navbar.php');
$user = $_GET['username'];  
?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<h1 class="card-title text-center"><i class="fas fa-user-circle"></i> Profil</h1>
        <p>User: <?php echo $_SESSION['username'];?></p>
        <form action="profilesave.php" method="post">
            <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $_SESSION['firstname'];?>" required>
            </div>    
            <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $_SESSION['lastname'];?>" required>
            </div>
				<div class="form-group">
                <label>Password (Kosongkan jika tidak mau membuat perubahan)</label>
                <input type="password" name="password" class="form-control">
            </div>                
            <div class="form-group text-center">
             	<input type="submit" class="btn btn-primary" value="Save">
            </div>
        </form>
        </div>    <!--Card Body-->
        </div>    <!--Card-->
    </div>    <!--Container-->

	<?php include_once('includes/footer.php'); ?>
</body>
</html>