<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password' AND status=1" );


	if (mysqli_num_rows($query) == 0) {
	
		header("location: ".BASE_URL."index.php?page=login&notif=true");
	
	}else{
	
	$row = mysqli_fetch_assoc($query);

	session_start();

	$_SESSION['user_id'] = $row['user_id'];
	$_SESSION['nama'] = $row['nama'];
	$_SESSION['level'] = $row['level'];

	if($_SESSION['proses_pemesanan'] == true) {

		header("location: ".BASE_URL."index.php?page=data_pemesan");
		unset($_SESSION['proses_pemesanan']);
	
	}else{
	
		header("location: ".BASE_URL."index.php?page=my_profile&module=pesanan&action=list");
	
	}

	}
?>