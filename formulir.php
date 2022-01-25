<?php
if (isset($_POST['simpan'])){
	$jenis=$_POST['jenis'];
	$formulir=$_FILES['formulir']['name'];
	$keterangan=$_POST['keterangan'];
	$folder="file/";
	$folder=$folder.basename($formulir);

$errors= array();
		      $file_name = $_FILES['formulir']['name'];
		      $file_size =$_FILES['formulir']['size'];
		      $file_tmp =$_FILES['formulir']['tmp_name'];
		      $file_type=$_FILES['formulir']['type'];
		      $file_ext=strtolower(end(explode('.',$_FILES['formulir']['name'])));
		      
		      $expensions= array('docx','rtf','odt','doc');
		      
		      if(in_array($file_ext,$expensions)=== false){
		         $errors[]="extension not allowed, please choose a DOCX, RTF, ODT, DOC.";
		      }
		      
		      if($file_size > 2097152){
		         $errors[]='File size must be excately 2 MB';
		      }

				 $extractFile = pathinfo($_FILES['formulir']['name']);
				 $sameName = 0; // Menyimpan banyaknya file dengan nama yang sama dengan file yg diupload
				 $handle = opendir('file/');
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
			      	move_uploaded_file($file_tmp,"file/".$newName);
			      	$query="insert into tb_formulir values ('','$jenis','$newName','$keterangan')";
					$res=$con->query($query);
					if ($res){
						echo "Formulir Telah Disimpan";
					}else{
						echo "Gagal Disimpan";
					}
			      }else{ echo "Gagal Upload File"; }



	
}
?>

<?php
if (!empty($_GET['hapus'])){
	include "kon.php";
	$id_formulir=$_GET['hapus'];
	$query="delete from tb_formulir where id_formulir='$id_formulir'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?halaman=formulir');
	}
}
?>
<?php if (!empty($_GET['act']) and $_GET['act']=="tambah_formulir"){ ?>
<h3 style="margin-left: 0; margin-bottom: 20px;">Tambah Formulir</h3>
* Upload Formulir Surat yang nanti akan diisi oleh masyarakat<br>
* Pastikan Formulir yang di Upload dengan Format DOCX (Microsoft Work)
* Pada Keterangan isikan lebih jelas tentang tata cara atau syarat pengisian Formulir<br><br>
					<form action="#" method="POST" enctype="multipart/form-data">
						<label>Jenis Formulir</label><br>
						<input type="text" name="jenis" required=""><br>
						<label>Upload Formulir</label><br>
						<input type="file" name="formulir"><br>
						<label>Keterangan</label><br>
						<textarea id="txt" rows="10" name="keterangan"></textarea><br>
						<input class="btn-submit" type="submit" name="simpan" value="Simpan">
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

<?php if (empty($_GET['act'])){
$query="select * from tb_formulir order by jenis_formulir asc";
$formulir=$con->query($query);
?>
<h3 style="margin-left: 0; margin-bottom: 10px;">Data Formulir</h3>
<a class="btn-table" style="max-width: 150px; text-align: center;" href="index.php?halaman=formulir&amp;act=tambah_formulir">Tambah Formulir</a>
<table border="1px" cellspacing="0" cellpadding="5px" width="100%">
	<tr>
		<th>No</th>
		<th>Id Formulir</th>
		<th>Jenis Formulir</th>
		<th>File Formulir</th>
		<th>Aksi</th>
	</tr>
<?php
$n=1;
while ($df=$formulir->fetch_array(MYSQL_BOTH)){
	?>
	<tr>
		<td align="center"><?php echo $n; ?></td>
		<td align="center"><?php echo $df['id_formulir']; ?></td>
		<td><?php echo $df['jenis_formulir']; ?></td>
		<td align="center"><a href="file/<?php echo $df['formulir']; ?>">Download</a></td>
		<td align="center"><a class="btn-table" href="index.php?halaman=detail&amp;detail=<?php echo $df['jenis_formulir']; ?>&amp;layanan=true">Lihat</a> <a class="btn-table" href="formulir.php?hapus=<?php echo $df['id_formulir']; ?>">Hapus</a></td>
	</tr>
	<?php
	$n++;
}
?>
</table>
<?php } ?>