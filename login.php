<?php

	include_once("function/helper.php");
	if ($user_id) {
		header("location: ".BASE_URL);
	}
?>

<div id="container-user-akses">

	<form action="<?php echo BASE_URL."proses_login.php"; ?>" method="POST" />

	<?php 

	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
	$email =  isset($_GET['email']) ? $_GET['email']: false;
	
	if ($notif==true){
		echo "<div class='notif'>Username atau password salah. Belum Punya Akun? <a href='".BASE_URL."index.php?page=register'>Register</a>
		</div>
		";
	}

	?>

	<div class="element-form">
		<label>Email</label>
		<span><input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>"/> </span>
	</div>

	<div class="element-form">
		<label>Password</label>
		<span><input type="password" name="password" placeholder="Password" /> </span>
	</div>

	<div class="element-form">
		<span><button>Login</button> </span>
	</div>

</div>