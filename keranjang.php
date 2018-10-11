<?php 

	
	if ($keranjang == null) {
		echo "Mohon maaf, belum ada barang di dalam keranjang belanja anda";
	}else{
		$no=1;

		echo "<table class='table-list'>
			  <tr class='baris-title'>
				<th class='tengah'>No</th>
				<th class='kiri'>Image</th>
				<th class='kiri'>Nama Barang</th>
				<th class='tengah'>Qty</th>
				<th class='kanan'>Harga Satuan</th>
				<th class='kanan'>Total</th>
			  </tr>";
			  
			  $subtotal = 0;
			  foreach($keranjang AS $key => $value){
			  	$barang_id = $key;

			  	$gambar = $value["gambar"];
			  	$nama_barang = $value["nama_barang"];
			  	$quantity = $value["quantity"];
			  	$harga = $value["harga"];
			  	$total = $quantity * $harga;

			  	$subtotal = $subtotal + $total;

				echo "<tr>
						<td class='tengah'>$no</td>
						<td class='kiri'><img src='".BASE_URL."images/barang/$gambar' height='100px'></td>
						<td class='kiri'>$nama_barang</td>
						<td class='tengah'><input type='number' name='$barang_id' value='$quantity' class='update-quantity' /></td>
						<td class='kanan'>".rupiah($harga)."</td>
						<td class='kanan hapus_item'>".rupiah($total)." <a href='".BASE_URL."hapus_item.php?barang_id=$barang_id'>X</a></td>
					  </tr>";
				$no++;

				$queryQuantity = mysqli_query($koneksi, "SELECT nama_barang, stok FROM barang WHERE barang_id=$barang_id");
				$row = mysqli_fetch_assoc($queryQuantity);
				
					$stok = $row['stok'];
					$nama_barang = $row['nama_barang'];
				
					if ($quantity>$stok) {
						$_SESSION['notif-quantity'] = true;

						echo "<div class='notif-quantity'>Mohon maaf order melibihi stok barang yang ada<br> 
						Stok <b>$nama_barang</b> saat ini : $stok</div>";
					}else{
						unset($_SESSION['notif-quantity']);
					}
			   
			   }

			   echo "<tr>
						<td class='kanan'colspan=5><b>Sub Total</b></td>
						<td class='kanan'><b>".rupiah($subtotal)."</b></td>
					  </tr>";

			   echo "</table>";
			   
			   echo "<div id='frame-button-keranjang'>
			   			<a id='lanjut-belanja' href='".BASE_URL."index.php'>< Lanjut Belanja</a>			   
			   			<a id='lanjut-pemesanan' href='".BASE_URL."index.php?page=data_pemesan'>Lanjut Pemesanan ></a>
			   		 </div>";
	}
 ?>

 <script type="text/javascript">
 	$(".update-quantity").on("input", function(e) {
 		var barang_id = $(this).attr("name");
 		var value = $(this).val();

 			$.ajax({
 				method: "POST",
 				url: "update_keranjang.php",
 				data: "barang_id="+barang_id+"&value="+value
 			})
 		
 		.done(function(data){
 			location.reload();
 		});
 	});
 </script>