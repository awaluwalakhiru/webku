<?php  
	include '../proses/koneksi.php';
	include '../header.php';

	$id = $_GET['id_anggota'];
	$q = "DELETE FROM anggota WHERE id_anggota = '$id' ";
	$query = mysqli_query($conn, $q);
	$num = mysqli_affected_rows($conn);

	if ($num > 0) { ?>
		<script>
			// alert('Data anda berhasil dihapus');
			// window.location.href = 'list_anggota.php';
			Swal({
                title: 'Status',
                text: "Data anda berhasil dihapus",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'yes'
                }).then((result) => {
                if (result.value) {
                    window.location.href = "list_anggota.php";
                }
                })
		</script>
	<?php } else { ?>
		<script>
			// alert('Data anda gagal dihapus');
			// window.location.href = 'list_anggota.php';
			Swal({
                title: 'Status',
                text: "Data anda gagal dihapus",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'yes'
                }).then((result) => {
                if (result.value) {
                    window.location.href = "list_anggota.php";
                }
                })
		</script>
	<?php } 

	include '../footer.php';
?>