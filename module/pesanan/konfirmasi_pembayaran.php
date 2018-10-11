<?php
	$pesanan_id = $_GET['pesanan_id'];
?>

<form action="<?php echo BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id"; ?>" method="POST">

	<div class="element-form">
		<label>Nama BANK</label>
		<span>
			<select name="nama_bank">
				<?php

				$queryBank = mysqli_query($koneksi, "SELECT * FROM bank");
				while ($row=mysqli_fetch_assoc($queryBank)) {
				$bank_id = $row['bank_id'];
				$nama_bank = $row['nama_bank'];

				echo "<option value='$bank_id'>$nama_bank</option>";
				}

				?>
			</select>
		</span>
	</div>
	
	<div class="element-form">
		<label>Nomor Rekening</label>
		<span><input type="number" name="nomor_rekening" placeholder="Nomor Rekening Anda"></span>
	</div>

	<div class="element-form">
		<label>Nama Account</label>
		<span><input type="text" name="nama_account" placeholder="Nama Pemilik Rekening"></span>
	</div>

	<div class="element-form">
		<label>Tanggal Tranfer (Format: mm-dd-yyy)</label>
		<span><input class="date" type="date" name="tanggal_transfer"></span>
	</div>

	<div class="element-form">
		<span><button name="button" value="Konfirmasi">Konfirmasi</button></span>
	</div>


</form>