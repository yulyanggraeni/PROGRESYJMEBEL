<?php

if (!defined('ADMIN_PATH')){
	define('ADMIN_PATH', dirname(__FILE__));
}

if (!defined('ADMIN_URL')){
	$urls = explode('/', $_SERVER['REQUEST_URI']);
	array_pop($urls);
	array_pop($urls);
	$url = implode("/", $urls);
	define('ADMIN_URL',  $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$url);
}

function base_url($url = ''){
	return ADMIN_URL.'/'.$url;
}

function filterNumber($str){
	return intval(preg_replace("/[^0-9]/", '', $str));
}

function filterAlphaNumeric($str = ''){
	return preg_replace("/[^A-Za-z0-9]/", '', $str);
}

function filterText($str = ''){
	return preg_replace("/[^A-Za-z0-9 ,_.-]/", '', $str);
}

function check_login(){
	$user = isset($_SESSION['username'])? $_SESSION['username'] : null;
	if(empty($user)){
		header("Location: ".ADMIN_URL); 
		exit();
	}
}

function redirect_back(){
	echo("<script>location.href = history.go(-1);</script>");
}

function logout(){
	$_SESSION['username'] = null;
	session_destroy();
	header("Location: ".ADMIN_URL."/index.php"); 
	exit();
}

function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
     
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function dump($d, $name = '', $dump = false){
	echo '<pre style="padding:5px; background-color:#ececec; margin: 20px; 0">';
	if(!empty($name)) echo "<h3 style='color:blue;'><strong>$name</strong></h3>";
	if($dump){var_dump($d);}else{print_r($d);}
	echo '</pre>';
}

function setKode($no, $pre = 'TRA'){
	$l = "ABCDEFGHIJKLMNOPQRSTUVWXYZ7890123456";
	return $pre."-".$l[intval(date('d'))].str_pad($no, 4, "0", STR_PAD_LEFT);
}

function validateDate($date, $format = 'Y-m-d H:i:s'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

function convertValidDate($date, $source_format = 'd-m-Y', $destination_format = 'Y-m-d'){
	if(validateDate($date, $source_format)){
		//$date = convertDate($date, $destination_format);
		$date = DateTime::createFromFormat($source_format, $date);
		$date = $date->format($destination_format);
	}else{
		$date = date($destination_format);
	}
	return $date;
}

function uploadImage($name = NULL, $id = 0){
	if(isset($_FILES[$name])){
		$ext = explode('.', $_FILES[$name]["name"]);
		$ext = strtolower(end($ext));
		
		$target_dir = "upload/bayar/";
		$target_file = $target_dir.md5($id.'-'.microtime()).'.'.$ext;
		$uploadOk = true;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		
		$msg = '';

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES[$name]["tmp_name"]);
			if($check !== false) {
				$msg = "File is an image - " . $check["mime"] . ".";
				$uploadOk = true;
			} else {
				$msg = "File is not an image.";
				$uploadOk = false;
			}
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			$msg = "Sorry, file already exists.";
			$uploadOk = false;
		}

		// Check file size
		if ($_FILES[$name]["size"] > 500000) {
			$msg = "Sorry, your file is too large.";
			$uploadOk = false;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = false;
		}

		// Check if $uploadOk is set to 0 by an error
		if (!$uploadOk) {
			$msg = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$name]["tmp_name"], ADMIN_PATH.'/'.$target_file)) {
				$msg = "Bukti berhasil diupload";
			} else {
				$msg = "Sorry, there was an error uploading your file.";
			}
		}
		return array('status' => $uploadOk, 'pesan' => $msg, 'file' => $target_file);
	} else {
		return array('status' => false, 'pesan' => "No Image Uploaded", 'file' => null);
	}
}