<?php
if (!isset($_SESSION)){
	session_start();
}
$con=new mysqli("localhost","root","","nagari");
if ($con){

}else{
	echo "Koneksi Gagal";
}
?>