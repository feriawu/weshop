<?php
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");
	
	$nama_barang = $_POST['nama_barang'];
	$kategori_id = $_POST['kategori_id'];
	$spesifikasi = $_POST['spesifikasi'];
	$status = $_POST['status'];
	$button = $_POST['button'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];

	$nama_file = $_FILES["file"]["name"];
	move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/barang/".$nama_file);
	
	if ($button == "Add") {
		mysqli_query($koneksi, "INSERT INTO barang (nama_barang, kategori_id, spesifikasi, status, harga, stok) 
			VALUES ('".$nama_barang."', '".$kategori_id."', '".$spesifikasi."', '".$status."', '".$harga."', '".$stok."')");
	}
	elseif ($button == "Update") {
		$barang_id = $_GET['barang_id'];
		$update = mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama_barang', spesifikasi='$spesifikasi', harga='$harga', stok='$stok', status='$status' WHERE barang_id='$barang_id'");
	}else{
		$barang_id = $_POST['barang_id'];
		mysqli_query($koneksi, "DELETE FROM barang WHERE barang_id=$barang_id");
	}

	header("location: ".BASE_URL."index.php?page=my_profile&module=barang&action=list");
?>
