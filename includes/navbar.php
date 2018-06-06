<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="index.php"><i class="fas fa-users"></i> SJBBI<sup>beta</sup></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item<?php if($nav_id==1){echo " active";} ?>">
            <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
          </li>
          <li class="nav-item<?php if($nav_id==3){echo " active";} ?>">
            <a class="nav-link" href="meeting.php"><i class="far fa-calendar-alt"></i> Kalender</a>
          </li>
          <li class="nav-item<?php if($nav_id==5){echo " active";} ?>">
            <a class="nav-link" href="meeting_pengumuman.php"><i class="fas fa-bullhorn"></i> Pengumuman</a>
          </li>
          <li class="nav-item<?php if($nav_id==9){echo " active";} ?>">
            <a class="nav-link" href="meeting_tugas.php"><i class="fas fa-book"></i> Tugas Siswa</a>
          </li>
          <li class="nav-item<?php if($nav_id==4){echo " active";} ?>">
            <a class="nav-link" href="meeting_ku.php"><i class="fas fa-list-ol"></i> Jadwal KU</a>
          </li>
          <li class="nav-item<?php if($nav_id==6){echo " active";} ?>">
            <a class="nav-link" href="person_away.php"><i class="fas fa-plane"></i> Away</a>
          </li>
					<li class="nav-item<?php if($nav_id==7){echo " active";} ?>">
            <a class="nav-link" href="notes.php"><i class="far fa-sticky-note"></i> Catatan</a>
          </li>
<!-- 					<li class="nav-item<?php if($nav_id==8){echo " active";} ?>">
            <a class="nav-link" href="#"><i class="fas fa-user"></i> Person</a>
          </li>-->

          <?php if($_SESSION['admin'] == 1 && $nav_id==2){
          	echo '<li class="nav-item"><a class="nav-link active" href="admin.php"><i class="fas fa-certificate"></i> Admin</a></li>';}
				if($_SESSION['admin'] == 1 && $nav_id!=2){
          	echo '<li class="nav-item"><a class="nav-link" href="admin.php"><i class="fas fa-certificate"></i> Admin</a></li>';}
				?> 
        </ul>
		<li class="nav-item dropdown" style="list-style:none;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
          <i class="fas fa-user-circle"></i> <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./profile.php">Profil Saya</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="./logout.php">Logout</a>
        </div>
      </li>
      </div>
    </nav>
<?php
//alert system
$alertid = $_GET['a'];
switch($alertid) {
	case "tpcreatesuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Perhimpunan Tengah Pekan berhasil dibuat!
</div>';
	break;
	case "apcreatesuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Perhimpunan Akhir Pekan berhasil dibuat!
</div>';
	break;
	case "deletesuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Record berhasil dihapus!
</div>';
break;
	case "profilesaved":
echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Profil berhasil diperbarui!
</div>';
	break;
	case "profilepasswordsaved":
echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  Profil dan password berhasil diperbarui!
</div>';
	break;
	case "entrycreated":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
Record berhasil dibuat!
</div>';
	break;
	case "verifysuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
  User sudah di-verified!
</div>';
	break;
  case "notecreatesuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
Catatan berhasil dibuat!
</div>';
	break;
  case "noteeditsuccess":
		echo '<div class="alert alert-success alert-dismissable"> 
<button type="button" class="close" data-dismiss="alert">&times;</button>
Catatan berhasil diedit!
</div>';
	break;
	default:
		echo "";
}
?>