<?php session_start();
    include("../function.php");
    logout();
    echo "<script>alert('Logout Berhasil');document.location.href='../index.php';</script>";
?>