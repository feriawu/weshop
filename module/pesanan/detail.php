<?php

	$pesanan_id = $_GET['pesanan_id'];

	$query = mysqli_query($koneksi, "SELECT pesanan.status, pesanan.pesanan_id, pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

	$row = mysqli_fetch_assoc($query);

	$pesanan_id = $row['pesanan_id'];
	$nama_penerima = $row['nama_penerima'];
	$nomor_telepon = $row['nomor_telepon'];
	$alamat = $row['alamat'];
	$tanggal_pemesanan = $row['tanggal_pemesanan'];
	$nama = $row['nama'];
	$kota = $row['kota'];
	$tarif = $row['tarif'];
	$status = $row['status'];
?>

<div id="frame-faktur">
	
	<h3>
		<center>Detail Pesanan</center>
	</h3>

	<hr/>

	<table>
		
		<tr>
			<td>Nomor Faktur</td>
			<td>: <?php echo $pesanan_id; ?></td>
		</tr>		

		<tr>
			<td>Nama Pemesan</td>
			<td>: <?php echo $nama; ?></td>
		</tr>

		<tr>
			<td>Nama Penerima</td>
			<td>: <?php echo $nama_penerima; ?></td>
		</tr>

		<tr>
			<td>Alamat Pengiriman</td>
			<td>: <?php echo "$alamat, $kota"; ?></td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>: <?php echo $nomor_telepon; ?></td>
		</tr>

		<tr>
			<td>Tanggal Pemesanan</td>
			<td>: <?php echo $tanggal_pemesanan; ?></td>
		</tr>

	</table>

</div>

	<table class="table-list">
		
		<tr class="baris-title">
			<th class="nomor">No</td>
			<th class="kiri">Nama Barang</td>
			<th class="tengah">Qty</td>
			<th class="kanan">Harga Satuan</td>
			<th class="kanan">Total</td>
		</tr>

		<?php

			$queryDetail = mysqli_query($koneksi, "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id WHERE pesanan_detail.pesanan_id='$pesanan_id'" );

			$no = 1;
			$subtotal = 0;



			while ($rowDetail=mysqli_fetch_assoc($queryDetail)) {
			
				$total = $rowDetail['harga'] * $rowDetail['quantity'];
				$subtotal = $subtotal + $total;
			
				echo "<tr class>

						<td class='nomor'>$no</td>
						<td class='kiri'>$rowDetail[nama_barang]</td>
						<td class='tengah'>$rowDetail[quantity]</td>
						<td class='kanan'>".rupiah($rowDetail['harga'])."</td>
						<td class='kanan'>".rupiah($total)."</td>
					  </tr>";

				$no++;
			}

			$subtotal = $subtotal + $tarif;

		?>
		
		<tr>
			<td class='kanan' colspan=4><b>Biaya Pengiriman</b></td>
			<td class='kanan'><b><?php echo rupiah($tarif) ?></b></td>
		</tr>

		<tr>
			<td class='kanan' colspan=4><b>Sub Total</b></td>
			<td class='kanan'><b><?php echo rupiah($subtotal) ?></b></td>
		</tr>
	
	</table>

	<div id="frame-keterangan-pembayaran">
		
		<p>
			Silahkan lakukan pembayaran ke BANK BCA<br/>
			Nomor Rekening : <b>864 000 1969 a/n KARYADI DIANANTHA</b><br/>
			Setelah melakukan pembayaran silahkan lakukan konfirmasi pembayaran
			
			<?php
				if($status == 0){

					echo "<a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id'>Klik Disni</a>";
				
				}else{

					echo "<b class='konfirmasi'>Pembayaran Telah Dikonfirmasi</b>";

				}
			?>
		</p>

	</div>