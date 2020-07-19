<?php
//koneksi ke database
$server = "localhost";
$username = "root";
$password = "";
$database = "yj-mebel"; //nama database yang akan di pakai

$mysqli = new mysqli ($server, $username, $password, $database);
if (mysqli_connect_errno()){
    echo 'Koneksi gagal dilakukan dengan alasan :'.mysqli_connect_error(); 
    exit();
    mysqli_close($mysqli);
}
?>