<?php
ini_set("display_errors", 0);
session_start(); //memulai session
include "koneksi.php";
$username = $_POST['username'];//mengambil isian username dan password dari form
$password = $_POST['password'];
// $nama = $_POST['nama'];
// $alamat = $_POST['alamat'];
// $telepon = $_POST['telepon'];


$cekUsername = mysqli_query($mysqli,"SELECT * FROM tb_customer WHERE username_cust LIKE '$username'");
if($cekUsername){
	$row = mysqli_fetch_assoc($cekUsername);
	if($row["password_cust"] == md5($password)){
		$_SESSION['username_cust'] = $row['username_cust'];
		$_SESSION['id_cust'] = $row['id_cust'];
		$_SESSION['telepon'] = $row['telepon'];
		echo "<script>alert('Login Berhasil');document.location.href='index2.php';</script>";
	}
	else{
		echo "<script>alert('Pasword Anda Salah');document.location.href='login.php';</script>";
	}
}
else{
	echo "<script>alert('Username Tidak Ditemukan');document.location.href='login.php';</script>";
}
?>
