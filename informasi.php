<?php
if (isset($_POST['kirim'])){
	$judul=$_POST['judul'];
	$isi=strip_tags($_POST['isi']);
	$id_pengguna=$_SESSION['id_pengguna'];


$errors= array();
		      $file_name = $_FILES['gambar']['name'];
		      $file_size =$_FILES['gambar']['size'];
		      $file_tmp =$_FILES['gambar']['tmp_name'];
		      $file_type=$_FILES['gambar']['type'];
		      $file_ext=strtolower(end(explode('.',$_FILES['gambar']['name'])));
		      
		      $expensions= array('jpg','jpeg','pjpeg','png','x-png');
		      
		      if(in_array($file_ext,$expensions)=== false){
		         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		      }
		      
		      if($file_size > 1097152){
		         $errors[]='File size must be excately 1 MB';
		      }

				 $extractFile = pathinfo($_FILES['gambar']['name']);
				 $sameName = 0; // Menyimpan banyaknya file dengan nama yang sama dengan file yg diupload
				 $handle = opendir('gambar/');
				 while(false !== ($file = readdir($handle))){ // Looping isi file pada directory tujuan
				 // Apabila ada file dengan awalan yg sama dengan nama file di uplaod
				 if(strpos($file,$extractFile['filename']) !== false)
				 $sameName++; // Tambah data file yang sama
				 }
				 
				 /* Apabila tidak ada file yang sama ($sameName masih '0') maka nama file pakai 
				 * nama ketika diupload, jika $sameName > 0 maka pakai format "namafile($sameName).ext */
				 $newName = empty($sameName) ? $file_name : $extractFile['filename'].'('.$sameName.').'.$extractFile['extension'];
				 $newName=str_replace(' ', '-', $newName);
      
			      if(empty($errors)==true){
			      	move_uploaded_file($file_tmp,"gambar/".$newName);
			      	$query="insert into tb_informasi values ('','$judul','$isi','$newName',Now(),'$id_pengguna')";
						$res=$con->query($query);
						if ($res){
							?>
							<script>
								window.location.href="index.php?halaman=data_informasi";
							</script>
							<?php
						}else{
							echo "Gagal Dikirim<br><a href='index.php?halaman=tambah_informasi'>Kembali</a>";
						}
			      }else{ echo "Gagal Upload Gambar <br><a href='index.php?halaman=tambah_informasi'>Kembali</a>"; }

}

if (isset($_GET['hapus'])){
	include "kon.php";
	$id_informasi=$_GET['hapus'];
	$query="delete from tb_informasi where id_informasi='$id_informasi'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?halaman=data_informasi');
	}
}
?>

<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="tambah_informasi"){ ?>
<h3 style="margin-left: 0; margin-top: 0; margin-bottom: 10px;">Informasi Baru</h3>
<form action="#" method="POST" enctype="multipart/form-data">
	<label>Judul Informasi</label><br>
	<input type="text" name="judul" maxlength="100" required=""><br>
	<label>Isi Informasi</label><br>
	<textarea name="isi" id="txt" rows="20" ></textarea><br>
	<label>Upload Gambar</label><br>
	<input type="file" name="gambar" required=""><br>
	<input class="btn-submit" type="submit" name="kirim" value="Kirim">
</form>

 <script src="tinymce/tinymce.min.js"></script>
            <script type="text/javascript">
tinymce.init({
    selector: "#txt",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<?php } ?>


<?php
if (!empty($_GET['halaman']) and $_GET['halaman']=="data_informasi"){
$query="select * from tb_pengguna,tb_informasi where tb_informasi.id_pengguna=tb_pengguna.id_pengguna order by tb_informasi.tgl_post desc";
$res=$con->query($query);
?>

<h3 style="margin-left: 0; margin-bottom: 20px;">Data Informasi</h3>
<a class="btn-table" style="max-width: 150px; text-align: center;" href="index.php?halaman=tambah_informasi">Tambah Informasi</a>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px">
	<tr>
		<th>No</th>
		<th>Judul</th>
		<th>Gambar</th>
		<th>Tgl Post</th>
		<th>Post By</th>
		<th>Aksi</th>
	</tr>
	<?php $n=1; while ($dp=$res->fetch_array(MYSQL_BOTH)) {
		?>
		<tr>
			<td align="center"><?php echo $n; ?></td>
			<td><?php echo $dp['judul']; ?></td>
			<td align="center"><img width="100px" height="80px" src="gambar/<?php echo $dp['gambar']; ?>" /></td>
			<td align="center"><?php echo date('d-M-Y',strtotime($dp['tgl_post'])); ?></td>
			<td align="center"><?php echo $dp['nama_lengkap']; ?></td>
			<td align="center"><a class="btn-table" href="informasi.php?hapus=<?php echo $dp['id_informasi']; ?>">Hapus</a></td>
		</tr>
		<?php $n++; } ?>
</table>
<?php } ?>

