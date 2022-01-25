<?php
include "kon.php";
$query="select * from tb_formulir order by jenis_formulir asc";
$formulir=$con->query($query);
?>
<center>
<h1 style="margin: 5px;">Nagari Padang Lua</h1>
<h3 style="margin: 0;">Rekap Data Formulir</h3>
<i>Alamat : Padang Lua, Telpon : 08123456789, Fax : 454545, Kode Pos : 4544656</i>
</center>
<hr style="margin-top: 10px; margin-bottom: 0;">
<hr style="margin-top: 0; margin-bottom: 10px;">
<table border="1px" cellspacing="0" cellpadding="5px" width="100%">
	<tr>
		<th>No</th>
		<th>Id Formulir</th>
		<th>Jenis Formulir</th>
		<th>File Formulir</th>
		<th>Keterangan</th>
	</tr>
<?php
$n=1;
while ($df=$formulir->fetch_array(MYSQL_BOTH)){
	?>
	<tr>
		<td align="center"><?php echo $n; ?></td>
		<td align="center"><?php echo $df['id_formulir']; ?></td>
		<td><?php echo $df['jenis_formulir']; ?></td>
		<td><?php echo $df['formulir']; ?></td>
		<td><?php echo $df['keterangan']; ?></td>
	</tr>
	<?php
	$n++;
}
?>
</table>

<div style="float: right; margin-right: 50px;">
<br><br>
	Padang Lua,<?php echo date('d-M-Y'); ?>
	<br><br><br><br>
	<center><?php echo strtoupper($_SESSION['username']); ?></center>
</div>
<script>
	window.print();
</script>