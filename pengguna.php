<?php
if (isset($_POST['simpan'])){
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$telpon=$_POST['telpon'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	if ($password<>$repassword){
		echo "Kombinasi Password tidak Sesuai";
	}else{
		$query="insert into tb_pengguna values ('','$nama','$alamat','$telpon','$username','$password','pengguna',Now())";
		$res=$con->query($query);
		if ($res){
			echo "Pendaftaran Sukses<br>Anda dapat login <a href='index.php?halaman=login'>DISINI</a>";
		}
	}
}

if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query="select * from tb_pengguna where username='$username' and password='$password'";
	$res=$con->query($query);
	$nr=$res->num_rows;
	if ($nr>0){
		$rp=$res->fetch_array();
		$_SESSION['id_pengguna']=$rp['id_pengguna'];
		$_SESSION['nama_lengkap']=$rp['nama_lengkap'];
		$_SESSION['username']=$rp['username'];
		$_SESSION['level']=$rp['level'];
		?>
		<script>
			window.location.href="index.php";
		</script>
		<?php
	}else{
		?>
		<script>
			window.location.href="index.php?halaman=login";
		</script>
		<?php
	}
}

if (!empty($_GET['hapus'])){
	include "kon.php";
	$id_pengguna=$_GET['hapus'];
	$query="delete from tb_pengguna where id_pengguna='$id_pengguna'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?halaman=data_pengguna');
	}
}

if (!empty($_GET['admin'])){
	include "kon.php";
	$id_pengguna=$_GET['admin'];
	$query="update tb_pengguna set level='admin' where id_pengguna='$id_pengguna'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?halaman=data_pengguna');
	}
}

if (!empty($_GET['pengguna'])){
	include "kon.php";
	$id_pengguna=$_GET['pengguna'];
	$query="update tb_pengguna set level='pengguna' where id_pengguna='$id_pengguna'";
	$res=$con->query($query);
	if ($res){
		header('location:index.php?halaman=data_pengguna');
	}
}

if (!empty($_GET['logout']) and $_GET['logout']=="true"){
	session_start();
	session_destroy();
	header('location:index.php');
}
?>
<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="daftar"){ ?>
	<h3 style="margin-left: 0; margin-bottom: 20px;">Pendaftaran Pengguna</h3>
	<form action="#" method="POST">
		<label>Nama Lengkap</label><br>
		<input type="text" name="nama" maxlength="50" required=""><br>
		<label>Alamat Lengkap</label><br>
		<textarea name="alamat" required=""></textarea><br>
		<label>Telpon / HP</label><br>
		<input type="text" name="telpon" maxlength="20" required=""><br>
		<label>Username</label><br>
		<input type="text" name="username" required="" maxlength="30"><br>
		<label>Password</label><br>
		<input type="password" name="password" maxlength="30" required=""><br>
		<label>Ulangi Password</label><br>
		<input type="password" name="repassword" maxlength="50" required=""><br>
		<input class="btn-submit" type="submit" name="simpan" value="Daftar">	
	</form>
	
<?php } ?>

<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="login"){ ?>
	<h3 style="margin-left: 0; margin-bottom: 20px;">Silahkan Login</h3>
	<form action="#" method="POST">
	<label>Username</label><br>
	<input type="text" name="username" maxlength="30" style="width: 200px;" required=""><br>
	<label>Password</label><br>
	<input type="password" name="password" maxlength="30" style="width: 200px;" required=""><br>
	<input class="btn-submit" type="submit" name="login" value="Login">
	</form>
<?php } ?>


<?php if (!empty($_GET['halaman']) and $_GET['halaman']=="data_pengguna"){
$query="select * from tb_pengguna order by tgl_daftar desc";
$res=$con->query($query);
?>
<h3 style="margin-left: 0; margin-bottom: 20px;">Data Pengguna</h3>
<table border="1px" width="100%" cellspacing="0" cellpadding="5px">
	<tr>
		<th>No</th>
		<th>Nama Lengkap</th>
		<th>Telpon</th>
		<th>Username</th>
		<th>level</th>
		<th>Tgl Daftar</th>
		<th>Aksi</th>
	</tr>
	<?php $n=1; while ($dp=$res->fetch_array(MYSQL_BOTH)) {
		?>
		<tr>
			<td align="center"><?php echo $n; ?></td>
			<td><?php echo $dp['nama_lengkap']; ?></td>
			<td align="center"><?php echo $dp['telpon']; ?></td>
			<td align="center"><?php echo $dp['username']; ?></td>
			<td align="center"><?php echo $dp['level']; ?></td>
			<td align="center"><?php echo $dp['tgl_daftar']; ?></td>
			<td align="center">
			<?php if ($dp['level']=="admin"){ ?>
			<a class="btn-table" href="pengguna.php?pengguna=<?php echo $dp['id_pengguna']; ?>">Jadikan Pengguna</a>
			<?php }else{ ?> <a class="btn-table" href="pengguna.php?admin=<?php echo $dp['id_pengguna']; ?>">Jadikan Admin</a><?php } ?> <a class="btn-table" href="pengguna.php?hapus=<?php echo $dp['id_pengguna']; ?>">Hapus</a></td>
		</tr>
		<?php $n++; } ?>
</table>
<?php } ?>