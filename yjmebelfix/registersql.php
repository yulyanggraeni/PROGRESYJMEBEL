<?php
include "koneksi.php"; // memanggil file koneksi.php untuk menghubungkan ke database
 
if(isset($_POST['simpan'])){
    $username_cust     = $_POST['username_cust']; // memanggil nama variabel id untuk dibuat menjadi variabel baru $id
    $password_cust    = md5($_POST['password_cust']);
    $nama    = $_POST['nama'];
    $alamat    = $_POST['alamat'];
    $telepon    = $_POST['telepon'];

    $cekUsername = mysqli_query($mysqli,"SELECT username_cust FROM tb_customer WHERE username_cust LIKE '$username_cust'");
    $rowsCekUsername = mysqli_num_rows($cekUsername);
    if($rowsCekUsername > 0){
        echo "<script>alert('Username Sudah Dipakai');document.location.href='register.php';</script>";
    }
    else{
        //menambahkan query sql tambah data untuk memasukkan data ke database
        $data = mysqli_query($mysqli,"INSERT INTO tb_customer SET username_cust='$username_cust', password_cust='$password_cust', nama='$nama', alamat='$alamat', telepon='$telepon'");
        //  untuk mengetahui apakah data berhasil disimpan atau belum
        if ($data) {
            echo "<script>alert('Akun Berhasil Dibuat');document.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Akun Gagal Dibuat');document.location.href='register.php';</script>";
        }
    }
}
?>
