<?php 
include_once ('includes/secure.php');
include_once('includes/Parsedown.php');
$nav_id = 7;
$page = 'notes.php';
$id = $_GET['id'];
$action = $_GET['action'];
include_once('includes/dbconfig.php');
if($action=="delete"){
		$sql = "DELETE FROM notes WHERE notes_id=$id";
		if ($conn->query($sql) === TRUE) {
			header('location: ./notes.php?a=deletesucess');
		} else {
		echo "Error deleting record: ".$sql."<br>" . $conn->error;
		}
//		 $conn->close();
	}
?>

<?php //FORM
include_once('includes/dbconfig.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//get POST variables
	$id = $_GET['id'];  
  $title = mysqli_real_escape_string($conn,trim($_POST['title']));
  $content = mysqli_real_escape_string($conn,trim($_POST['notes']));
  $modifiedby = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];		
	$sql = "UPDATE notes SET title='$title', content='$content', modifiedby='$modifiedby', modifieddate=now() WHERE notes_id='$id'";
	if ($conn->query($sql) === TRUE) {
    header("location: notes_show.php?a=noteeditsuccess&id=".$id);
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
    <button type="button" class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#exampleModal">+<i class="far fa-sticky-note"></i></button>

      <?php
      include_once('includes/dbconfig.php');
      		$fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];		
		$sql = "Select * from notes WHERE notes_id=$id";
      $result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
          $title = $row['title'];
          $content = $row['content'];
          $contentpre = Parsedown::instance()
   			->setBreaksEnabled(true) // enables automatic line breaks
   			->text($row['content']);
          $modifieddate = date_create($row['modifieddate']);
          $createddate = date_create($row['createddate']);          
          $modifiedby = $row['modifiedby'];
          $createdby = $row['createdby'];
        } 
      } else {
		    echo "0 results";
		}
		$conn->close();
?>
<center><a href="#exampleModal" data-toggle="modal" data-target="#exampleModal" class="card text-left" style="max-width: 40em;background-color:#ffc;color:black;">
      <div class="card-body">
				<h4 class="card-title">
					<?php echo $title; ?>
				</h4>
				<p class="card-text">
					<?php echo $contentpre; ?>
				</p>

				<p class="card-text text-muted mt-2 mb-1" style="font-size:0.3em;">
          Tap di mana saja untuk meng-edit.
        </p>

        <p class="card-text text-muted mt-0" style="font-size:0.5em;">
          Terakhir diupdate pada <?php echo date_format($modifieddate, 'd/m/y H:i'); ?> oleh <?php echo $modifiedby; ?>
        </p>
      </div>
					</a></center>
		<p>
			<a href="notes.php" class="btn btn-primary">Kembali</a>
		</p>
  </div>

	 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-left" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
						<input type="hidden" name="id" class="form-control" id="title" placeholder="Masukkan judul catatan" value="<?php echo $id; ?>">
						<div class="form-group">
              <label for="title"><i class="fa fa-certificate"></i> Judul</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan judul catatan" value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
              <label for="notes"><i class="far fa-sticky-note"></i> Catatan <small class="text-muted">Mendukung Markdown</small></label>
              <textarea class="form-control" name="notes" rows="15"><?php echo $content; ?></textarea>
            </div>
            <center><button type="submit" class="btn btn-primary">Save</button> <a href="notes_show.php?id=<?php echo $id; ?>&action=delete" class="btn btn-danger">Delete</a></center>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 
  <?php include_once('includes/footer.php'); ?>
</body>

</html>