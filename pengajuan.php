<?php
if (isset($_POST['simpan'])){
	$id_pengguna=$_SESSION['id_pengguna'];
	$jenis=$_POST['jenis'];
	$file=$_FILES['file']['name'];
	$folder="file/";
	$folder=$folder.basename($file);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $folder)){
		$query="insert into tb_pengajuan values ('','$jenis','$file','Menunggu','',Now(),'$id_pengguna')";
		$res=$con->query($query);
		if ($res){
			echo "<h4>Surat Pengajuan Anda Berhasil Dikirim.</h4>";
		}else{
			echo "<h4>Gagal Mengirim Surat Pengajuan</h4>";
		}
	}else{
		echo "<h4>Gagal Upload File Pengajuan.</h4>";
	}
}

if (isset($_POST['update'])){
	include "kon.php";
	$id_pengajuan=$_POST['id_pengajuan'];
	$status=$_POST['status'];
	$catatan=$_POST['catatan'];
	$query="update tb_pengajuan set status_pengajuan='$status',catatan_admin='$catatan' where id_pengajuan='$id_pengajuan'";
	$res=$con->query($query);
	if ($res){
		echo "<h4 style='margin-left:0; margin-bottom:10px;'>Pengajuan ".$status."</h4><a href='index.php?halaman=data_pengajuan'>Kembali</a><hr>";
	}
}

if (isset($_GET['act']) and $_GET['act']=="hapus"){
	include "kon.php";
	$id_pengajuan=$_GET['id_pengajuan'];
	$query="delete from tb_pengajuan where id_pengajuan='$id_pengajuan'";
	$res=$con->query($query);
	if ($res){
		echo "Pengajuan Dihapus<br><a href='index.php?halaman=data_pengajuan'>Kembali</a>";
	}
}

if (!empty($_GET['halaman']) and $_GET['halaman']=="data_pengajuan"){
 if ($_SESSION['level']=="admin"){ 
$query="select * from tb_pengajuan,tb_pengguna,tb_formulir where tb_pengguna.id_pengguna=tb_pengajuan.id_pengguna and tb_pengajuan.id_formulir=tb_formulir.id_formulir order by tgl_pengajuan asc";
$res=$con->query($query);
}else{
	$id_pengguna=$_SESSION['id_pengguna'];
	$query="select * from tb_pengajuan,tb_pengguna,tb_formulir where tb_pengguna.id_pengguna=tb_pengajuan.id_pengguna and tb_pengajuan.id_formulir=tb_formulir.id_formulir and tb_pengajuan.id_pengguna='$id_pengguna' order by tgl_pengajuan asc";
$res=$con->query($query);
}
?>
<h3 style="margin-top: 0; margin-bottom: 5px; margin-left: 0;">Data Pengajuan</h3>
<table border="1px" width="100%" cellpadding="5px" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>Pengajuan</th>
		<th>File Pengajuan</th>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Catatan</th>
		<?php if ($_SESSION['level']=="admin"){ ?>
		<th>Aksi</th>
		<?php } ?>
	</tr>
	<?php $n=1; while ($rs=$res->fetch_array(MYSQL_BOTH)) {
		?>
		<tr>
			<td align="center"><?php echo $n; ?></td>
			<td><?php echo $rs['nama_lengkap']; ?></td>
			<td><?php echo $rs['jenis_formulir']; ?></td>
			<td align="center"><a href="file/<?php echo $rs['file_pengajuan']; ?>">Download</a></td>
			<td align="center"><?php echo $rs['tgl_pengajuan']; ?></td>
			<td align="center"><?php echo $rs['status_pengajuan']; ?></td>
			<td><?php echo $rs['catatan_admin']; ?></td>
			<?php if ($_SESSION['level']=="admin"){ ?>
			<td align="center">
				<?php if ($rs['status_pengajuan']=="Menunggu"){ ?>
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=tunda&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Tunda</a> 
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=proses&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Proses</a> 
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=tolak&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Tolak</a> 
				<?php }else if ($rs['status_pengajuan']=="Diproses"){ ?>
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=tolak&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Tolak</a> 
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=selesai&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Selesai</a>
				<?php }else if ($rs['status_pengajuan']=="Ditolak"){ ?>
					<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=hapus&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Hapus</a>	 
				<?php }else if ($rs['status_pengajuan']=="Ditunda"){ ?>
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=proses&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Proses</a> 
				<a class="btn-table" href="index.php?halaman=konfirmasi&amp;act=tolak&amp;id_pengajuan=<?php echo $rs['id_pengajuan']; ?>">Tolak</a>
				<?php }else if ($rs['status_pengajuan']=="Selesai"){ 
				echo "Telah Selesai"; 
				} ?>
			</td>
			<?php } ?>
		</tr>
		<?php $n++; } ?>
</table>

<?php } ?>

<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="konfirmasi" and !empty($_GET['act']) and $_GET['act']<>"hapus"){ ?>
	<h3  style="margin-left: 0; margin-bottom: 15px;">Konfirmasi Surat Pengajuan</h3>
	<form action="#" method="POST">
		<input type="hidden" name="id_pengajuan" value="<?php echo $_GET['id_pengajuan']; ?>" required="">
		<input type="hidden" name="status" value="<?php 
		if ($_GET['act']=="tolak"){ echo "Ditolak"; }else 
		if ($_GET['act']=="tunda"){ echo "Ditunda"; }else
		if ($_GET['act']=="proses"){ echo "Diproses"; }else
		if ($_GET['act']=="selesai"){ echo "Selesai"; }
		?>" required="">
		<label>Status Pengajuan : <b>
		<?php 
		if ($_GET['act']=="tolak"){ echo "Ditolak"; }else 
		if ($_GET['act']=="tunda"){ echo "Ditunda"; }else
		if ($_GET['act']=="proses"){ echo "Diproses"; }else
		if ($_GET['act']=="selesai"){ echo "Selesai"; }
		?></b></label><br><br>
		<label>Catatan untuk Pengaju Surat</label><br>
		<textarea name="catatan"></textarea><br>
		<input class="btn-submit" type="submit" name="update" value="Submit">
	</form>
<?php } ?>

<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="pengajuan_surat"){
			if (empty($_SESSION['id_pengguna'])){
				echo "Silahkan Login Terlebih dahulu. .<br>Klik <a href='index.php?halaman=login'>DISINI</a> untuk Login";
			}else{
	?>
	<h3 style="margin-left: 0; margin-bottom: 20px;">Pengajuan Surat</h3>
	<form action="#" method="POST" enctype="multipart/form-data">
		<label>Jenis Pengajuan</label><br>
		<select name="jenis" required="">
			<option value="">-- Pilih --</option>
			<?php
			      $query="select * from tb_formulir order by jenis_formulir asc";
			      $res=$con->query($query);
			      while ($data=$res->fetch_array(MYSQL_BOTH)){
			      	?>
			      	<option value="<?php echo $data['id_formulir']; ?>"><?php echo $data['jenis_formulir']; ?></option>
			      	<?php
			      }
			      ?>
		</select><br>
		<label>Upload File Pengajuan</label><br>
		<input type="file" name="file" required=""><br>
		<input type="submit" name="simpan" value="Kirim" class="btn-submit">
	</form>
<?php } } ?>