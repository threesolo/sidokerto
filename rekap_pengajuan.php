 <?php
if (isset($_POST['tampilkan'])){
include "kon.php";
$dari=date('Y-m-d',strtotime($_POST['dari']));
$sampai=date('Y-m-d',strtotime($_POST['sampai']));
$status=$_POST['status'];
if ($status=="Semua"){
$query="select * from tb_pengajuan,tb_pengguna,tb_formulir where (tb_pengajuan.tgl_pengajuan between '$dari' and '$sampai') and tb_pengguna.id_pengguna=tb_pengajuan.id_pengguna and tb_pengajuan.id_formulir=tb_formulir.id_formulir";
$res=$con->query($query);
$rc=$res->num_rows;	
}else{
$query="select * from tb_pengajuan,tb_pengguna,tb_formulir where (tb_pengajuan.tgl_pengajuan between '$dari' and '$sampai') and tb_pengajuan.status_pengajuan='$status' and tb_pengguna.id_pengguna=tb_pengajuan.id_pengguna and tb_pengajuan.id_formulir=tb_formulir.id_formulir";
$res=$con->query($query);
$rc=$res->num_rows;
}
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rekap Data Pengajuan</title>
  <link rel="stylesheet" href="jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
  $( function() {
    var dateFormat = "mm-dd-yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "m",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "m",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
</head>
<body>
<?php if (!isset($_POST['tampilkan'])){ ?>
<div style="width:98%; background:#eee; padding:1%; display:block;">
<center>
<form action="#" method="POST"> 
<label for="from">Dari</label>
<input type="text" id="from" name="dari" required="">
<label for="to">Sampai</label>
<input type="text" id="to" name="sampai" required="">
<label for="status">Status Pengajuan</label>
<select name="status" required="">
	<option value="">-- Pilih --</option>
	<option value="Ditunda">Ditunda</option>
	<option value="Diproses">Diproses</option>
	<option value="Ditolak">Ditolak</option>
	<option value="Selesai">Selesai</option>
	<option value="Semua">Tampilkan Semua</option>
</select>
<input type="submit" name="tampilkan" value="Cetak">
</form>
</center>
</div>
<?php } ?>
<?php if (isset($_POST['tampilkan'])){ ?>
<center>
<h1 style="margin: 5px;">Nagari Padang Lua</h1>
<h3 style="margin: 0;">Rekap Data Pengajuan</h3>
<i>Alamat : Padang Lua, Telpon : 08123456789, Fax : 454545, Kode Pos : 4544656</i>
</center>
<br>
Dari Tanggal : <?php echo $dari; ?> Sampai : <?php echo $sampai; ?> , Status Pengajuan : <?php if ($status<>"Semua"){ echo $status; }else{ echo "Semua"; } ?>
<hr style="margin-top: 10px; margin-bottom: 0;">
<hr style="margin-top: 0; margin-bottom: 10px;">

<table border="1px" width="100%" cellpadding="5px" cellspacing="0">
	<tr>
		<th>No</th>
		<th>Nama Lengkap</th>
		<th>Alamat</th>
		<th>Telpon</th>
		<th>Pengajuan</th>
		<th>File Pengajuan</th>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Catatan</th>
	</tr>
	<?php $n=1; while ($rs=$res->fetch_array(MYSQL_BOTH)) {
		?>
		<tr>
			<td align="center"><?php echo $n; ?></td>
			<td><?php echo $rs['nama_lengkap']; ?></td>
			<td><?php echo $rs['alamat']; ?></td>
			<td><?php echo $rs['telpon']; ?></td>
			<td><?php echo $rs['jenis_formulir']; ?></td>
			<td align="center"><?php echo $rs['file_pengajuan']; ?></td>
			<td align="center"><?php echo $rs['tgl_pengajuan']; ?></td>
			<td align="center"><?php echo $rs['status_pengajuan']; ?></td>
			<td><?php echo $rs['catatan_admin']; ?></td>
		</tr>
		<?php $n++; } ?>
</table>
<div style="float: left; margin-left: 30px;">
<br>
    Jumlah Pengajuan : <?php echo $rc; ?>
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
<?php } ?>
</body>
</html>

