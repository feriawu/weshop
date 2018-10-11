<?php
	
	session_start();
	unset($_SESSION['user_id']);
	unset($_SESSION['keranjang']);

	header("location: index.php")

?>