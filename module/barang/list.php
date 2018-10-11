<div id="frame-tambah">
	<a href="<?php echo BASE_URL.'index.php?page=my_profile&module=barang&action=form' ?>" class="tombol-action">+ Tambah Barang</a>
</div>

<?php
	
	$querybarang = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id ORDER BY kategori ASC");

	if (mysqli_num_rows($querybarang) == 0) {
		echo "<h3>Belum ada Barang</h3>";
	}else{
		echo "<table class='table-list'>";
		echo "<tr>
				<th class='nomor'>No</th>
				<th class='kiri'>Barang</th>
				<th class='kiri'>Kategori</th>
				<th class='kiri'>Harga</th>
				<th class='tengah'>Status</th>
				<th class='tengah'>Action</th>
			  </tr>";

		$no=1;
		while ($row=mysqli_fetch_assoc($querybarang)) {
			$button	= "delete";

		echo "<tr>
				<td class='nomor'>$no</td>
				<td class='kiri'>$row[nama_barang]</td>
				<td class='kiri'>$row[kategori]</td>
				<td class='kiri'>".rupiah($row["harga"])."</td>
				<td class='tengah'>$row[status]</td>
				<td class='tengah'>
					<a class='edit' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit</a>

	<form action='".BASE_URL."module/barang/action.php?barang_id=$row[barang_id]' method='POST'>
					<input type='hidden' name='barang_id' value=$row[barang_id]>

					<span class='delete'> <input type='submit' name='button' value=".$button."> </span>
					</form>
				</td>
			  </tr>";
			  $no++;
		}
		echo "</table>";
	}

?>