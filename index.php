<?php include "kon.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Nagari Padang Lua</title>
	<style>
		body{
			margin: 0;
			padding: 0;
			background:#eee;
			color: #444;
			background: -moz-linear-gradient(bottom, #eef, #fee);

		}
		.container{
			width: 76%; margin-left: 10%; background:#fff; padding: 0 2% 1% 2%; display: inline-block;
		}
		.header h1{
			display: block;
			margin-top: 0;
			margin-bottom: 5px;
			color: indianred;
			letter-spacing: 5px;
			text-align: center;
		}
		.header h2{
			margin: 0;
			padding: 0;
			margin-bottom: 20px;
			color: steelblue;
			text-align: center;
		}
		.nav {
			width: 100%;
			border-top: 0;
			border-left: 0;
			border-right: 0;
			border-bottom: 2px;
			border-color: #00ffdb;
			display: block;
			border-style: solid;


		}
		.nav ul {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #66959b;
		    background: -moz-linear-gradient(right, #66959b, #ff959b);
		}

		.nav ul li {
		    float: left;
		}

		.nav ul li a, .dropbtn {
		    display: inline-block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		}

		.nav ul li a:hover, .dropdown:hover .dropbtn {
		    background-color: #067272;
		}

		.nav ul .dropdown {
		    display: inline-block;
		}

		.dropdown .dropdown-content {
		    display: none;
		    position: absolute;
		    background-color: #f9f9f9;
		    min-width: 160px;
		    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		    z-index: 1;
		}

		.dropdown .dropdown-content a {
		    color: black;
		    padding: 12px 16px;
		    text-decoration: none;
		    display: block;
		    text-align: left;
		}

		.dropdown .dropdown-content a:hover {background-color: #f1f1f1}

		ul .dropdown:hover .dropdown-content {
		    display: block;
		}
		.section{
			width: 100%;
			 min-height: 500px;
		}
		.section .left{
			clear: both;
			float: left;
			width: 22%;
			display: block;
			margin-top: 10px;
		}
		.section .center{
			clear: none;
			float: left;
			width: 54%;
			display: block;
			background:transparent;
			margin-top: 10px;
			margin-left: 1%;
			margin-right: 1%;
		}
		.section .right{
			clear: none;
			float: left;
			width: 22%;
			display: block;
			margin-top: 10px;
		}
		.footer{
			width: 100%;
			clear: both;
			float: none;
			background-color:#66959b;
			border-radius: 5px; 
		}
		.footer i{
			padding: 5px;
			display: block;
			color: white;
		}
		.menu{
			width: 94%;
			margin-bottom: 20px;
			background-color: #f8f8f8;
			padding: 3%;
		}
		.content{
			width: 100%;			
		}
		.content h3{
			margin: 5px;
		}
		.menu ul{
			list-style: none;
			width: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		.menu ul li {
			float: none;
		}
		.menu ul li a{
			text-decoration: none;
			padding: 10px 14px;
			background: transparent;
			display: block;
			color: #888;
		}
		.menu ul li a:hover{
			background: #fff;
		}
		input, textarea, select{
			width: 100%;
			margin-bottom: 10px;
			padding-left: 0;
			padding-top: 5px;
			padding-bottom: 5px;
			padding-right: 0;
		}
		.btn-submit{
			padding: 10px 16px;
			font-size: 16px;
			font-weight: 800;
			border:0;
			max-width: 150px;
			background:#1fa49f;
			color: white;
		}
		.btn-submit:hover{
			background:#333;
		}
		.btn-table{
			padding: 2px 2px;
			background:#c84b4b;
			color: #fff;
			text-decoration: none;
			margin: 2px;
			display: block;
		}
		.btn-table:hover{
			background:#ddd;
			color: #333;
		}
		h3{
			color: #666;
		}
		th{
			background-color: #f2f2f2;
		}
		b{
			color: #888;
		}
		.artikel{
			width:46%; padding: 2%; float: left; clear: none;
		}
		.artikel img{
			height: 160px; text-align: center; opacity: 0.8; max-width: 100%;
		}
		.artikel img:hover{
			opacity: 1;
		}
		
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
			<br>
			<h1>Nagari Padang Lua</h1>
			<h2><small>Basamo Mamajukan Nagari Tacinto</small></h2>
		</div>
		<div class="nav">
			<ul>
			  <li><a href="index.php">Beranda</a></li>
			  <li><a href="index.php?halaman=profil">Profil</a></li>
			  <li><a href="index.php?halaman=visimisi">Visi & Misi</a></li>
			  <li class="dropdown">
			    <a href="javascript:void(0)" class="dropbtn">Formulir Layanan</a>
			    <div class="dropdown-content">
			      <?php
			      $query="select * from tb_formulir order by jenis_formulir asc";
			      $res=$con->query($query);
			      while ($data=$res->fetch_array(MYSQL_BOTH)){
			      	?>
			      	<a href="index.php?halaman=detail&amp;detail=<?php echo $data['jenis_formulir']; ?>&amp;layanan=true"><?php echo $data['jenis_formulir']; ?></a>
			      	<?php
			      }
			      ?>
			    </div>
			  </li>
			  <li><a href="index.php?halaman=pengajuan_surat">Pengajuan Surat</a></li>
			  <?php if (empty($_SESSION['id_pengguna'])){ ?>
			  <li style="float: right;"><a href="index.php?halaman=daftar">Daftar</a></li>
			  <li style="float: right;"><a href="index.php?halaman=login">Login</a></li>
			  <?php }else{ ?>
			  <li style="float: right;"><a href="pengguna.php?logout=true">Logout</a></li>
			  <?php } ?>
			</ul>
		</div>
		<div class="section">
			<div class="left">
				<?php if (!empty($_SESSION['id_pengguna'])){ ?>
					<div class="menu">
						<h3 style="margin:0 0 10px 0;">Active</h3>
						Pengguna :
							<b><?php echo $_SESSION['username']; ?></b><br>
						Nama :
							<b><?php echo $_SESSION['nama_lengkap']; ?></b><br>
						Level :
							<b><?php echo $_SESSION['level']; ?></b><br>
						
					</div>
						<?php } ?>

						<?php if (!empty($_SESSION['id_pengguna']) and $_SESSION['level']=="admin"){ ?>
					<div class="menu">
						<h3 style="margin:0 0 10px 0;">Menu Admin</h3>
							<ul>
								<li><a href="index.php?halaman=data_informasi">Informasi</a></li>
								<li><a href="index.php?halaman=formulir">Formulir</a></li>
								<li><a href="index.php?halaman=data_pengguna">Data Pengguna</a></li>
								<li><a href="index.php?halaman=data_pengajuan">Data Pengajuan</a></li>
							</ul>
							<hr>
							<ul>
								<li><a target="_blank" href="rekap_pengajuan.php?halaman=rekap_pengajuan">Rekap Pengajuan</a></li>
								<li><a target="_blank" href="rekap_pengguna.php">Rekap Pengguna</a></li>
								<li><a target="_blank" href="rekap_formulir.php">Rekap Formulir</a></li>
							</ul>
					</div>
				<?php } ?>
					<?php if (!empty($_SESSION['id_pengguna']) and $_SESSION['level']<>"admin"){ ?>
						<div class="menu">
						<h3 style="margin:0 0 10px 0;">Menu Pengguna</h3>
							<ul>
								<li><a href="index.php?halaman=data_pengajuan">Data Pengajuan</a></li>
							</ul>	
							</div>
					<?php } ?>
				<div class="menu">
					<h3 style="margin:0 0 10px 0;">Formulir Layanan</h3>
					<ul>
					<?php
			      $query="select * from tb_formulir order by jenis_formulir asc";
			      $res=$con->query($query);
			      while ($data=$res->fetch_array(MYSQL_BOTH)){
			      	?>
			      	<li><a href="index.php?halaman=detail&amp;detail=<?php echo $data['jenis_formulir']; ?>&amp;layanan=true"><?php echo $data['jenis_formulir']; ?></a></li>
			      	<?php
			      }
			      ?>
			      </ul>
				</div>

				<div class="menu">
					<h3 style="margin: 0;">Surat Pengajuan Disetujui</h3>
					Surat Pengajuan yang telah disetujui dapat dijemput ke kantor nagari
					<hr>
					<?php
					$query="select * from tb_pengajuan,tb_pengguna,tb_formulir where tb_pengguna.id_pengguna=tb_pengajuan.id_pengguna and tb_pengajuan.id_formulir=tb_formulir.id_formulir and status_pengajuan='Selesai' order by tgl_pengajuan desc limit 10";
					$res=$con->query($query);
					$no=1;
					while ($ds=$res->fetch_array(MYSQL_BOTH)) {
						?>
						<h5 style="margin: 0;"><?php echo $no.". ".$ds['nama_lengkap']; ?></h5>
						<p><?php echo $ds['jenis_formulir']; ?></p>
					<?php
					$no++;
					}
					?>

				</div>
			</div>
			<div class="center">
				<div class="content">
					<?php
					if (empty($_GET['halaman'])){
						?>
						<h3 style="margin: 0;">Informasi</h3>
						<?php
					$query="select * from tb_informasi,tb_pengguna where tb_pengguna.id_pengguna=tb_informasi.id_pengguna order by tb_informasi.tgl_post desc";
				    $res=$con->query($query);
				    while ($data=$res->fetch_array(MYSQL_BOTH)){
					    ?>
					    <div class="artikel">
					      	<center><a href="index.php?halaman=detail&amp;detail=<?php echo $data['judul']; ?>&amp;informasi=true">
					      		<img src="gambar/<?php echo $data['gambar']; ?>" />
					      	</a></center>
					      	<a style="text-decoration: none;" href="index.php?halaman=detail&amp;detail=<?php echo $data['judul']; ?>&amp;informasi=true"><h3 style="margin-left: 0; margin-bottom: 10px; font-size: 14px; text-align: center;"><?php echo $data['judul']; ?></h3></a>
					     </div>
					      	
				    <?php
				    	}
					}
				      
					if (!empty($_GET['halaman']) and $_GET['halaman']=="formulir"){
						include "formulir.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="daftar"){
						include "pengguna.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="login"){
						include "pengguna.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="data_pengguna"){
						include "pengguna.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="profil"){
						include "profil.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="visimisi"){
						include "visimisi.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="pengajuan_surat"){
						include "pengajuan.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="data_pengajuan"){
						include "pengajuan.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="konfirmasi"){
						include "pengajuan.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="data_informasi"){
						include "informasi.php";
					}
					if (!empty($_GET['halaman']) and $_GET['halaman']=="tambah_informasi"){
						include "informasi.php";
					}

					if (!empty($_GET['halaman']) and !empty($_GET['layanan']) and !empty($_GET['detail'])){
					$jenis_formulir=$_GET['detail'];
					$query="select * from tb_formulir where jenis_formulir='$jenis_formulir'";
				    $res=$con->query($query);
				    if ($data=$res->fetch_array()){
					?>
					      	<h3 style="margin-left: 0; margin-bottom: 10px;"><?php echo $data['jenis_formulir']; ?></h3>
					      	<div style="line-height: 30px; font-size: 16px;"><?php echo $data['keterangan']; ?></div>
					      	<center><a href="file/<?php echo $data['formulir']; ?>">Download <?php echo $data['jenis_formulir']; ?></a></center>
				    <?php
				    	}						
					}

					if (!empty($_GET['halaman']) and !empty($_GET['informasi']) and !empty($_GET['detail'])){
					$judul=$_GET['detail'];
					$query="select * from tb_informasi,tb_pengguna where tb_pengguna.id_pengguna=tb_informasi.id_pengguna and tb_informasi.judul='$judul'";
				    $res=$con->query($query);
				    if ($data=$res->fetch_array()){
					?>
					      	<h3 style="margin-left: 0; margin-bottom: 10px; font-size: 30px;"><?php echo $data['judul']; ?></h3>
					      	<span>Post By : <?php echo $data['nama_lengkap']; ?> || Date Post : <?php echo date('d-M-Y',strtotime($data['tgl_post'])); ?></span><br><br>
					      	<center><a href="gambar/<?php echo $data['gambar']; ?>">
					      		<img width="100%" src="gambar/<?php echo $data['gambar']; ?>" />
					      	</a></center>
					      	<div style="line-height: 30px; font-size: 16px;"><?php echo $data['isi']; ?></div>
				    <?php
				    	}						
					}
										
					?>
				</div>
			</div>
			<div class="right">
				<div class="menu">
					<h3 style="margin-top:0; margin-left: 0; margin-bottom: 10px;">Wali Nagari</h3>
					<img src="wali-nagari.jpg" width="100%"/>
					<center><b>Nengki Rahmat</b></center>
				</div>

				<div class="menu">
					<h3 style="margin-top:0; margin-left: 0; margin-bottom: 10px;">Wakil Wali Nagari</h3>
					<img src="wakil-wali-nagari.jpg" width="100%"/>
					<center><b>Reno Berta</b></center>
				</div>

				<div class="menu">
				<h3>Informasi Terbaru</h3>
					<?php
					$query="select * from tb_informasi,tb_pengguna where tb_pengguna.id_pengguna=tb_informasi.id_pengguna order by tb_informasi.tgl_post desc limit 5";
				    $res=$con->query($query);
				    while ($data=$res->fetch_array(MYSQL_BOTH)){
					    ?>
					   	<a style="text-decoration: none;" href="index.php?halaman=detail&amp;detail=<?php echo $data['judul']; ?>&amp;informasi=true"><h3 style="margin-left: 0; margin-bottom: 10px; font-size: 14px; "><?php echo $data['judul']; ?></h3></a><hr style="margin: 0;">
					     
					      	
				    <?php
				    	}
					?>
				</div>
			</div>
		</div>
		<div class="footer"><i><center>Copyright &copy; Nagari Padang Lua - <?php echo date('Y'); ?> All Right Reserved</center></i></div>
	</div>
</body>
</html>