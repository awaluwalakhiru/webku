<?php  
	include '../proses/koneksi.php';
	include '../header.php';

	$id = $_POST['id_kategori'];
	$nama = stripslashes(trim(htmlspecialchars($_POST['nama_kategori'])));

	$q = "UPDATE kategori SET nama_kategori = '$nama' WHERE id_kategori = '$id'";
	$query = mysqli_query($conn, $q);
	$num = mysqli_affected_rows($conn);

	if ($num > 0) { ?>
		echo "<script>
			// alert('data berhasil diedit');
			// window.location.href = 'list_kategori.php';
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
				    window.location.href ='list_kategori.php';
				  }
				})
		</script>";
	 <?php } else { ?>
		<script>
			// alert('data gagal diedit');
			// window.location.href = 'edit_kategori.php';
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
				    window.location.href ='list_kategori.php';
				  }
				})
		</script>
	 <?php }

	include '../footer.php';
?>