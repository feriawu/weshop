<div id="frame-tambah">
	<a href="<?php echo BASE_URL.'index.php?page=my_profile&module=kategori&action=form' ?>" class="tombol-action">+ Tambah Kategori</a>
</div>

<?php
	
	$querykategori = mysqli_query($koneksi, "SELECT * FROM kategori");

	if (mysqli_num_rows($querykategori) == 0) {
		echo "<h3>Belum ada Kategori</h3>";
	}else{
		echo "<table class='table-list'>";
		echo "<tr>
				<th class='nomor'>No</th>
				<th class='kiri'>Kategori</th>
				<th class='tengah'>Status</th>
				<th class='tengah'>Action</th>
			  </tr>";

		$no=1;
		while ($row=mysqli_fetch_assoc($querykategori)) {
			$button	= "delete";
		echo "<tr>
				<td class='nomor'>$no</td>
				<td class='kiri'>$row[kategori]</td>
				<td class='tengah'>$row[status]</td>
				<td class='tengah'>
					<a class='edit' href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]'>Edit</a>

	<form action='".BASE_URL."module/kategori/action.php?kategori_id=$row[kategori_id]' method='POST'>
					<input type='hidden' name='kategori_id' value=$row[kategori_id]>

					<span class='delete'> <input type='submit' name='button' value=".$button."> </span>
					</form>
				</td>
			  </tr>";
			  $no++;
		}
		echo "</table>";
	}

?>