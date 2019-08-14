<?php  
	include '../proses/koneksi.php';
	include '../header.php';

	$nama = htmlspecialchars($_POST['nama_anggota']);
	$qu = "SELECT * FROM anggota WHERE nama_anggota = '$nama'";
	$q_cek = mysqli_query($conn, $qu);
	$result = mysqli_fetch_assoc($q_cek);

		if ($result['nama_anggota'] == $nama) {?>
			<script>
				// alert('Nama anggota telah ada mohon diganti');
				// window.location.href ='tambah_anggota.php';
				Swal({
				  title: 'Status',
				  text: "Nama anggota telah ada mohon diganti",
				  type: 'warning',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'ok'
				}).then((result) => {
				  if (result.value) {
				    window.location.href ='tambah_anggota.php';
				  }
				})
			</script>
		<?php } else { ?>
				<!-- <script>
					alert('Nama anda boleh digunakan')
				</script> -->
					<?php
						$alamat = htmlspecialchars($_POST['alamat_anggota']);
						$jenis = htmlspecialchars($_POST['jk_anggota']);
						$hp = htmlspecialchars($_POST['hp_anggota']);
						$q = "INSERT INTO anggota VALUES ('','$nama','$alamat','$jenis','$hp')";
						$query = mysqli_query($conn, $q);

						$num = mysqli_affected_rows($conn);

						if ($num > 0) { ?>
							<script>
								// alert('Data anda berhasil ditambahkan');
								// window.location.href = 'list_anggota.php';
								Swal({
								  title: 'Status',
								  text: "Data anda berhasil ditambahkan",
								  type: 'success',
								  showCancelButton: false,
								  confirmButtonColor: '#3085d6',
								  cancelButtonColor: '#d33',
								  confirmButtonText: 'ok'
								}).then((result) => {
								  if (result.value) {
								    window.location.href = 'list_anggota.php';
								  }
								})
							</script>
									<?php } else { ?>
										<script>
											// alert('Data anda gagal ditambahkan');
											// window.location.href = 'tambah_anggota.php';
											Swal({
											  title: 'Status',
											  text: "Data anda gagal ditambahkan",
											  type: 'error',
											  showCancelButton: false,
											  confirmButtonColor: '#3085d6',
											  cancelButtonColor: '#d33',
											  confirmButtonText: 'ok'
											}).then((result) => {
											  if (result.value) {
											    window.location.href = 'tambah_anggota.php';
											  }
											})
										</script>
									<?php }
		} 

	include '../footer.php';
?>