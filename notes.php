<?php 
include_once ('includes/secure.php');
$nav_id = 7;
$page = 'notes.php';
include_once('includes/Parsedown.php');
?>

<?php //FORM
include_once('includes/dbconfig.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//get POST variables
  $title = mysqli_real_escape_string($conn,trim($_POST['title']));
  $content = mysqli_real_escape_string($conn,trim($_POST['notes']));
  $fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];		
	$sql = "INSERT INTO notes ( title, content, createdby, modifiedby, createddate, modifieddate)
  VALUES ( '$title', '$content', '$fullname', '$fullname', now(), now() )";
	if ($conn->query($sql) === TRUE) {
    echo "testing";
    header("location: notes.php?a=notecreatesuccess");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once('includes/header.php'); ?>
  <title>SJBBI - Catatan</title>
  <style>
    a:hover {
      text-decoration: none;
    }
  </style>
</head>

<body class="text-center grad-royal">
  <?php 
include_once('includes/navbar.php');
?>
  <div class="container">
		<div class="input-group mb-3">
  <div class="input-group-prepend">
		<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">+<i class="far fa-sticky-note"></i></button>
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
  </div>
					<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Cari catatan..">
</div>
		

    <div class="card-columns" id="myUL">
      <?php
      include_once('includes/dbconfig.php');
      		$fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];		
		$sql = "Select * from notes ORDER BY modifieddate DESC";
      $result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
          $title = $row['title'];
          $content = Parsedown::instance()
   ->setBreaksEnabled(true) // enables automatic line breaks
   ->text($row['content']); 
//          $content = nl2br($row['content']);
          $modifieddate = date_create($row['modifieddate']);
          echo '<a href="notes_show.php?id=' . $row['notes_id'] . '" class="card" style="background-color:#ffc;color:black;">';
          echo '<div class="card-body text-left">';
          echo '<h4 class="card-title">'.$title.'</h4>';
          echo '<p class="card-text">'.$content.'</p>';
          echo '<p class="card-text text-muted" style="font-size:0.5em;">Terakhir diupdate pada '.date_format($modifieddate, 'd/m/y H:i').' oleh '.$fullname.'</p>';
          echo '</div></a>';
        } 
      } else {
		    echo "0 results";
		}
		$conn->close();
?>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-left" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buat Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
            <div class="form-group">
              <label for="title"><i class="fa fa-certificate"></i> Judul</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan judul catatan">
            </div>
            <div class="form-group">
              <label for="notes"><i class="far fa-sticky-note"></i> Catatan <small class="text-muted">Mendukung Markdown</small></label>
              <textarea class="form-control" name="notes" rows="5"></textarea>
            </div>
            <center><button type="submit" class="btn btn-primary">Save</button> <button type="reset" class="btn btn-danger">Reset</button></center>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
	<script>
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('a');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("div")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>