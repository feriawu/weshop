<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$level = "customer";
	$status = "1";
	$nama_lengkap = $_POST['nama_lengkap'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$alamat = $_POST['alamat'];
	$password = md5($_POST['password']);
	$repassword = md5($_POST['repassword']);

	//unset($_POST['password']);
	//unset($_POST['repassword']);

	$form = http_build_query($_POST);

	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'" );


	if (empty($nama_lengkap) || empty($email) || empty($phone) || empty($alamat) || empty($password) || empty($repassword)) {
		header("location: ".BASE_URL."index.php?page=register&notif=require&$form");
	}
	elseif ($password != $repassword) {
		header("location: ".BASE_URL."index.php?page=register&notif=password&$form");
	}elseif (mysqli_num_rows($query) >= 1) {
		header("location: ".BASE_URL."index.php?page=register&notif=email&$form");
	}else{
	mysqli_query($koneksi, "INSERT INTO user (level, nama, email, alamat, phone, password, status) 
		VALUES ('".$level."', '".$nama_lengkap."', '".$email."', '".$alamat."', '".$phone."', '".$password."', '".$status."') ");
		echo "<a href='http://localhost/weshop/index.php?page=login'>login</a>";

	}
?>