<!DOCTYPE html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
include_once('includes/dbconfig.php'); //load db
//get POST variables
$id = $_POST['id'];
$ap_lagu1 = $_POST['ap_lagu1'];  
$ap_ku_rangka = $_POST['ap_ku_rangka'];  
$speaker = $_POST['speaker'];
	$sidang = $_POST['sidang'];
	$penerjemah = $_POST['penerjemah'];
	$date = $_POST['date'];
	$rangka_lama = $_POST['rangka_lama'];
	$lagu_lama = $_POST['lagu_lama'];
	if(empty($rangka_lama)){$rangka_lama="Belum ditentukan";}
	if(empty($lagu_lama)){$lagu_lama="Belum ditentukan";}
	
//echo $id . '<br>lagu: '.$ap_lagu1.'<br>rangka: '.$ap_ku_rangka;
$sql = "UPDATE `Meetings` SET `ap_ku_rangka` = '$ap_ku_rangka', `ap_lagu1` = '$ap_lagu1' WHERE `Meetings`.`id` = $id";
//$sql = "UPDATE Meetings SET ap_lagu1='$ap_lagu1', ap_ku_rangka='$ap_ku_rangka', WHERE Meetings.id='$id'";

if ($conn->query($sql) === TRUE) {
	//Send email	
$mailto = "dpurnomo@outlook.com";
$mailsubject = '[SJBBI] Khotbah Tamu: '.$speaker . ' baru memperbarui informasi khotbah tamu';
$mailbody = 'Hi Daniel,<br><br>'.
	$speaker . ' baru memperbarui informasi rangka khotbah:<br><br>
	<b>Pengkhotbah:</b> ' .$speaker.'<br>
	<b>Sidang:</b> ' .$sidang . '<br>
	<b>Tanggal:</b> ' .$date . '<br>
	<b>Penerjemah:</b> ' . $penerjemah . '<br><br>
	<b>Rangka Lama:</b> ' . $rangka_lama . '<br>
	<b>Rangka Baru:</b> ' . $ap_ku_rangka . '<br><br>
	<b>Lagu Lama:</b> ' . $lagu_lama . '<br>
	<b>Lagu Baru:</b> ' . $ap_lagu1 . '<br><br>
	<a href="https://purnomo.net/sjbbi/meeting_ku_form.php?id='.$id.'">LINK</a><br><br><br>
	<b>Purnomo.net Bot</b>';
$mailbodyalt = $mailbody;
include_once ('sendmail.php');
//--------------------
  header("location: meeting_ku_form.php?id=".$id);

} else {
    echo "<span style='color:red;'>Error: " . $sql . "<br>" . $conn->error ."</span>";
}
//$conn->close();
}
?>

<html>

<head>
	<?php include_once('includes/header.php'); ?>
	<title>Formulir - SJBBI</title>
	<style>
		h5 {
			border-left: 2px solid black;
			background-color: #f0f0f0;
			text-align: left;
			padding-left: 4px;
			margin-bottom: 8px;
		}

	</style>
</head>

<body class="text-center grad-royal">
	<div class="container">
		<div class="row mt-4">
			<div class="col" style="margin-bottom:30px;">
				<div class="card">
					<div class="card-body" style="padding:2em;">
						<h3 class="card-title mb-3"><i class="fas fa-envelope"></i></h3>
						<?php include_once('includes/dbconfig.php');
						$id = $_GET['id'];
				$sql = "SELECT Meetings.date, Meetings.ap_ku, Meetings.ap_lagu1, Meetings.ap_ku_rangka, Meetings.ap_ku_sidang, Meetings.ap_ku_no, Meetings.ap_penerjemah, talk.theme 
				FROM Meetings INNER JOIN talk ON Meetings.ap_ku_rangka=talk.talk_id WHERE Meetings.id='$id' LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$sqldate = date_create($row['date'], new DateTimeZone('Asia/Jakarta'));
					$date = date_format($sqldate, 'l, d F Y');
					$speaker = $row['ap_ku'];
					$penerjemah = $row['ap_penerjemah'];
					$nomor = $row['ap_ku_rangka'];
					$tema = $row['theme'];
					$kontak = $row['ap_ku_no'];
					$sidang = $row['ap_ku_sidang'];
					$lagu = $row['ap_lagu1'];
				}
				} else {
					echo "No results1";
				}
				$sql = "SELECT Meetings.ap_lagu1, song.title 
				FROM Meetings INNER JOIN song ON Meetings.ap_lagu1=song.song_id WHERE Meetings.id='$id' LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$judullagu = $row['title'];
				}
				} else {
					echo "No results2";
				}
				$sql = "SELECT Meetings.ap_penerjemah, persons.mobile
				FROM Meetings INNER JOIN persons ON Meetings.ap_penerjemah=persons.fullname WHERE Meetings.id='$id' LIMIT 1";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$kontakpenerjemah = $row['mobile'];
				}
				} 
						
						?>
						<p class="text-left">
							Saudara
							<?php echo $speaker; ?> yang kami kasihi,<br><br>Terima kasih untuk kesediaannya berkhotbah tamu di sidang kami. Berikut kami senang memberikan informasi lebih lanjut tentang kedatangan Saudara ke sidang kami. Juga, mohon lengkapi informasi yang dibutuhkan di akhir dari
							halaman ini. Setelah perhimpunan, kami biasanya akan mengatur jamuan makan siang bersama saudara-saudari sidang kami. Terima kasih banyak.
							<br><br><i>Sidang Jakarta Barat Bahasa Isyarat</i>
						</p>
						<div>

							<h5 class="mt-4">
								Informasi
							</h5>
							<div class="text-left">
								<p class="card-text mb-0">
									<i class="fas fa-id-badge fa-fw"></i> <b>Nama:</b>
									<?php echo $speaker; ?>
								</p>
								<p class="card-text mb-0">
									<i class="fas fa-home fa-fw"></i> <b>Sidang:</b>
									<?php echo $sidang; ?>
								</p>
								<p class="card-text mb-2">
									<i class="fas fa-mobile fa-fw"></i> <b>Nomor Kontak:</b>
									<?php echo $kontak; ?>
								</p>


								<p class="card-text mb-0">
									<i class="fas fa-calendar fa-fw"></i> <b>Tanggal:</b>
									<?php echo $date . ', 9:30-11:15'; ?>
								</p>
								<p class="card-text mb-0">
									<i class="fas fa-list-ol fa-fw"></i> <b>Rangka Khotbah:</b>
									<?php if ($nomor==0) { echo '<span class="badge badge-pill badge-warning">Belum ditentukan. Pilih di bawah <i class="fas fa-arrow-circle-down"></i></span>'; } else {echo $nomor.' - '. $tema;} ?>
								</p>
								<p class="card-text mb-2">
									<i class="fas fa-music fa-fw"></i> <b>Lagu Pembuka:</b>
										<?php if (empty($lagu)) { echo '<span class="badge badge-pill badge-warning">Belum ditentukan. Pilih di bawah <i class="fas fa-arrow-circle-down"></i></span>'; } else {echo $lagu.' - '.$judullagu;} ?>
								</p>
								<?php if(empty($penerjemah)){echo "<!--";} ?>
								<p class="card-text mb-0">
									<i class="fas fa-american-sign-language-interpreting fa-fw"></i> <b>Penerjemah:</b>
									<?php echo $penerjemah; ?>
								</p>
								<p class="card-text mb-3">
									<i class="fas fa-mobile fa-fw"></i> <b>Nomor Kontak:</b>
									<?= $kontakpenerjemah; ?>
								</p>
								<?php if(empty($penerjemah)){echo "-->";} ?>

								<i class="fas fa-location-arrow fa-fw"></i> <b>Lokasi:</b>
								<p>
									Balai Kerajaan Gunung Sahari<br>Jl. Gunung Sahari IV No. 2<br> JAKARTA PUSAT – 10610 D.K.I JAKARTA<br><a href="https://goo.gl/maps/isyPC7UkPpA2"><i class="fas fa-map"></i> Google Maps</a>
								</p>

							</div>

							<h5>
								Mohon Isi / Update Informasi
							</h5>
							<br>
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<input type="hidden" name="speaker" value="<?php echo $speaker; ?>" />
								<input type="hidden" name="sidang" value="<?php echo $sidang; ?>" />
								<input type="hidden" name="date" value="<?php echo $date; ?>" />
								<input type="hidden" name="penerjemah" value="<?php echo $penerjemah; ?>" />
								<input type="hidden" name="rangka_lama" value="<?php echo $nomor; ?>" />
								<input type="hidden" name="lagu_lama" value="<?php echo $lagu; ?>" />
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" for="inputGroupSelect01">Rangka Khotbah</label>
									</div>
									<select class="custom-select" name="ap_ku_rangka" id="inputGroupSelect01">
									<option value="" <?php if (empty($nomor)){echo "selected" ;} ?>>Pilih...</option>
				<?php $sql = "SELECT * FROM talk ORDER BY talk_id LIMIT 1, 300";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$selected = "";
					$nomorlist = $row['talk_id'];
					$tema = $row['theme'];
					if ($nomorlist == $nomor) {
						$selected = " selected";
					}
					echo '<option value="'.$nomorlist.'"'.$selected.'>'.$nomorlist.' - ' .$tema.'</option>';
				}
				} else {
					echo "No results";
				}
										?>
								</select>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" for="inputGroupSelect02">Lagu Pembuka</label>
									</div>
									<select class="custom-select" name="ap_lagu1" id="inputGroupSelect02">
									<option value="" <?php if (empty($lagu)){echo "selected" ;} ?>>Pilih...</option>
<?php $sql = "SELECT * FROM song ORDER BY song_id LIMIT 1, 300";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$selected = "";
					$nomorlist = $row['song_id'];
					$tema = $row['title'];
					if ($nomorlist == $lagu) {
						$selected = " selected";
					}
					echo '<option value="'.$nomorlist.'"'.$selected.'>'.$nomorlist.' - ' .$tema.'</option>';
				}
				} else {
					echo "No results";
				}?>
								</select>
								</div>
								<small id="emailHelp" class="text-muted"><b>Catatan: </b>Lagu yang tersedia untuk bahasa isyarat belum selengkap bahasa Indonesia. Silakan pilih dari daftar.</small>
								<br><input class="mt-2 mb-4 btn btn-primary" type="submit" />
							</form>

							<?php if(empty($penerjemah)){echo "<!--";} ?>
							<h5>
								Jika Khotbah Saudara Diterjemahkan ke Bahasa Isyarat
							</h5>
							<div class="text-left">
								<p>
									<i>be hlm. 55 Mempersiapkan Ceramah Umum</i>
								</p>
								<p>
									<b>APABILA KHOTBAH SAUDARA DISAMPAIKAN MELALUI JURU BAHASA</b>
								</p>
								<p>
									Sering kali, karena digunakannya banyak bahasa di suatu negeri, para pengkhotbah umum mungkin diundang untuk menyampaikan khotbah Alkitab melalui juru bahasa. Jika Saudara diundang untuk berkhotbah dalam situasi seperti itu, petunjuk-petunjuk berikut
									ini akan membantu Saudara dan sang juru bahasa.
									<li>Keefektifan khotbah Saudara banyak bergantung pada mutu kerja sang juru bahasa. Bahkan, juru bahasa yang berpengalaman akan dapat menerjemah dengan lebih baik apabila Saudara membantunya membuat persiapan.</li>
									<li>Pada umumnya, Saudara harus mengurangi materi khotbah Saudara hingga sepertiganya untuk memberi ruang bagi pengalihbahasaan. (Bahasa isyarat merupakan pengecualian, karena pengalihbahasaan khotbah dapat disampaikan hampir secara bersamaan.)</li>
									<li>Sebelum berkhotbah, tinjaulah bersama sang juru bahasa garis besar rangka dan tujuan khotbah Saudara. Jika tugas khotbah Saudara berupa manuskrip di kebaktian, perlihatkan salinannya kepada sang juru bahasa jauh di muka.</li>
									<li>Bahaslah bersama sang juru bahasa ayat-ayat yang akan Saudara gunakan. Pastikan bahwa Alkitab bahasa setempat mengalihbahasakan gagasan yang sama seperti di Alkitab Saudara. Tunjukkan kepada sang juru bahasa ungkapan-ungkapan dari ayat yang hendak
										ditandaskan atau dijelaskan.</li>
									<li>Tentukan apakah ayat-ayatnya akan dibacakan dalam kedua bahasa atau satu bahasa saja. Membacakan ayat dalam bahasa sasaran sudah cukup memadai.</li>
									<li>Jika tanggal, angka, dan kutipan ayat diucapkan terlalu cepat, itu dapat menimbulkan masalah. Gunakanlah jeda yang tepat, dan bulatkanlah angka atau statistik.</li>
									<li>Bahaslah ilustrasi, idiom, dan ungkapan-ungkapan khas yang hendak Saudara gunakan. Pastikan agar juru bahasa Saudara mengerti maksudnya dan agar konsepnya tersampaikan dalam bahasa sasaran.</li>
									<li>Sewaktu berbicara, gunakan kalimat-kalimat pendek. Nyatakanlah gagasan lengkap sebelum membuat jeda bagi sang juru bahasa. (Juru bahasa akan menerjemahkan gagasan, tidak selalu kata per kata.) Demi kelancaran pengalihbahasaan, biarkan juru bahasa
										menyelesaikan kalimatnya sebelum Saudara melanjutkan khotbah.</li>
									<li>Sang juru bahasa sangat bergantung pada volume suara dan kejelasan pengucapan Saudara.</li>
								</p>
							</div>
							<?php if(empty($penerjemah)){echo "-->";} ?>

						</div>
					</div>
				</div>
			</div>
		</div>


		<?php include_once('includes/footer.php'); ?>
</body>

</html>