<?php  
	include '../proses/koneksi.php';
	include '../header.php';

	$id = $_POST['id_anggota'];
	$nama = htmlspecialchars($_POST['nama_anggota']);
	$alamat = htmlspecialchars($_POST['alamat_anggota']);
	$jk = htmlspecialchars($_POST['jk_anggota']);
	$hp = htmlspecialchars($_POST['hp_anggota']);

	$q = "UPDATE anggota SET nama_anggota = '$nama', alamat_anggota = '$alamat', jk_anggota = '$jk', hp_anggota = '$hp' WHERE id_anggota = '$id'";
	$query = mysqli_query($conn, $q);
	$num = mysqli_affected_rows($conn);

	if ($num > 0) { ?>
		echo "<script>
			// alert('data berhasil diedit');
			// window.location.href = 'list_anggota.php';
			Swal({
				  title: 'Status',
				  text: "Data anda berhasil diubah",
				  type: 'success',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'ok'
				}).then((result) => {
				  if (result.value) {
				    window.location.href ='list_anggota.php';
				  }
				})
		</script>";
	 <?php } else { ?>
		<script>
			// alert('data gagal diedit');
			// window.location.href = 'edit_anggota.php';
			Swal({
				  title: 'Status',
				  text: "Data anda gagal diubah",
				  type: 'error',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'ok'
				}).then((result) => {
				  if (result.value) {
				    window.location.href ='list_anggota.php';
				  }
				})
		</script>
	 <?php }

	include '../footer.php';
?>