<?php 
	include "kon.php";
$query="select * from tb_pengguna order by tgl_daftar desc";
$res=$con->query($query);
$rc=$res->num_rows;
?>
<center>
<h1 style="margin: 5px;">Nagari Padang Lua</h1>
<h3 style="margin: 0;">Rekap Data Pengguna</h3>
<i>Alamat : Padang Lua, Telpon : 08123456789, Fax : 454545, Kode Pos : 4544656</i>
</center>
<hr style="margin-top: 10px; margin-bottom: 0;">
<hr style="margin-top: 0; margin-bottom: 10px;">
<table border="1px" width="100%" cellspacing="0" cellpadding="5px">
	<tr>
		<th>No</th>
		<th>Nama Lengkap</th>
		<th>Telpon</th>
		<th>Username</th>
		<th>level</th>
		<th>Tgl Daftar</th>
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
			
		</tr>
		<?php $n++; } ?>
</table>
<div style="float:left; margin-left: 30px;"><br>
	Total Pengguna : <?php echo $rc; ?>
</div>
<div style="float: right; margin-right: 50px;">
<br><br>
	Padang Lua,<?php echo date('d-M-Y'); ?>
	<br><br><br><br>
	<center><?php echo strtoupper($_SESSION['username']); ?></center>
</div>
<script>
	window.print();
</script>