<?php

include_once("function/helper.php");
	if ($user_id) {
		header("location: ".BASE_URL);
	}
?>

<div id="container-user-akses">

	<?php 

	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
	$nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap']: false;
	$email =  isset($_GET['email']) ? $_GET['email']: false;
	$phone =  isset($_GET['phone']) ? $_GET['phone']: false;
	$alamat = isset($_GET['alamat']) ? $_GET['alamat']: false;
	
	if ($notif=='require'){
		echo "<div class='notif'>Maaf, Anda Harus Mengisi Semua Field</div>";
	}elseif ($notif=='password') {
		echo "<div class='notif'>Maaf, Password tidak sama</div>";
	}elseif ($notif=='email') {
		echo "<div class='notif'>Email sudah terdaftar, silahkan login</div>";
	}

	?>

	<form action="<?php echo BASE_URL."proses_register.php"; ?>" method="POST" />

	<div class="element-form">
		<label>Nama Lengkap</label>
		<span><input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" /> </span>
	</div>

	<div class="element-form">
		<label>Email</label>
		<span><input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>"/> </span>
	</div>

	<div class="element-form">
		<label>Nomor Telepon / Handphone</label>
		<span><input type="text" name="phone" placeholder="Nomor Handphone" value="<?php echo $phone; ?>"/> </span>
	</div>

	<div class="element-form">
		<label>Alamat</label>
		<span><textarea name="alamat" placeholder="Masukan Alamat. . ."><?php echo $alamat; ?></textarea> </span>
	</div>

	<div class="element-form">
		<label>Password</label>
		<span><input type="password" name="password" placeholder="Password" /> </span>
	</div>

	<div class="element-form">
		<label>Re-Type Password</label>
		<span><input type="password" name="repassword" placeholder="Re-Type Password" /> </span>
	</div>

	<div class="element-form">
		<span><button>Register</button> </span>
	</div>

</div>