<form method="post" action="">
	{{ csrf_field() }}
	<ul>
		<li>
			<label for="nik">NIK</label>
		</li>
		<li>
			<input type="text" name="nik" id="nik">
		</li>
		<li>
			<label for="nama">Nama</label>
		</li>
		<li>
			<input type="text" name="nama" id="nama">
		</li>
		<li>
			<label for="departemen">Departemen</label>
		</li>
		<li>
			<input type="text" name="departemen" id="departemen">
		</li>
		<li>
			<br>
			<button type="submit">Simpan</button>
		</li>
	</ul>
</form>