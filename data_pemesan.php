<?php
	
	$notif_quantity = isset($_SESSION['notif-quantity']) ? $_SESSION['notif-quantity'] : false;

	if ($user_id == false) {

		$_SESSION['proses_pemesanan'] = true;
		header("location: ".BASE_URL."index.php?page=login");
	}

	if ($notif_quantity) {
		header("location: ".BASE_URL."index.php?page=keranjang");

	}

?>

<div id="frame-data-pengiriman">

	<h3 class="label-data-pengiriman">Alamat Pengiriman Barang</h3>
	
	<div id="frame-form-pengiriman">
		
		<form action="<?php echo BASE_URL."proses_pemesanan.php"; ?>" method="POST">
		
			<div class="element-form">
				<label>Nama Penerima</label>
				<span><input type="text" name="nama_penerima" placeholder="Nama Lengkap"/> </span>
			</div>

			<div class="element-form">
				<label>Nomor Telepon</label>
				<span><input type="number" name="nomor_telepon" placeholder="Nomor Handphone"/> </span>
			</div>

			<div class="element-form">
				<label>Alamat Yang Dituju</label>
				<span><textarea name="alamat" placeholder="Alamat Lengkap"></textarea></span>
			</div>

			<div class="element-form">
				<label>Kota</label>
				<span>
					<select name="kota">
						<?php
							$query = mysqli_query($koneksi, "SELECT * FROM kota");
							while($row=mysqli_fetch_assoc($query)) {
								echo "<option value ='$row[kota_id]'>$row[kota](".rupiah($row[tarif]).")</option>";
							}
						?>					
					</select>	
				</span>
			</div>
		
			<div class="element-form">
				<span><button name="submit">Submit</button></span>
			</div>
		
		</form>
	</div>
</div>

<div id="frame-data-detail">
	<h3 class="label-data-pengiriman">Detail Order</h3>

	<div id="frame-detail-order">
		<table class="table-list">
			<tr>
				<th class="kiri">Nama Barang</th>
				<th class="tengah">Qty</th>
				<th class="kanan">Total</th>
			</tr>

			<?php

			$subtotal = 0;

			foreach ($keranjang as $key => $value) {
				$barang_id = $key;
				$nama_barang = $value['nama_barang'];
				$harga = $value['harga'];
				$quantity = $value['quantity'];
				$total = $quantity * $harga;
				$subtotal = $subtotal + $total;

				echo "<tr>
						<td class='kiri'>$nama_barang</td>
						<td class='tengah'>$quantity</td>
						<td class='kanan'>".rupiah($total)."</td>
					  </tr>";	
			}
			echo "<tr>
					<td class='kanan' colspan=2><b>Sub Total</b></td>
					<td class='kanan'><b>".rupiah($subtotal)."</b></td>
				  </tr>";
			?>

		</table>
	</div>
	
</div>