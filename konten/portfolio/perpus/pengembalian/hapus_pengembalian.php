<?php 
	include '../proses/koneksi.php';
    include '../header.php';

    if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }

   $id_kembali = $_GET['id_kembali'];

   $query = mysqli_query($conn, "DELETE FROM kembali WHERE id_kembali = '$id_kembali'");
   $num = mysqli_affected_rows($conn);

   if ($num > 0) { ?>
       <script>
            // alert('Data peminjaman berhasil ditambahkan');
            // window.location.href = 'list_peminjaman.php';
            Swal({
                title: 'Status',
                text: "Proses hapus data pengembalian sukses",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='list_pengembalian.php';
                }
              })
        </script>
   <?php } else { ?>
    <script>
            // alert('Data peminjaman berhasil ditambahkan');
            // window.location.href = 'list_peminjaman.php';
            Swal({
                title: 'Status',
                text: "Proses hapus data pengembalian gagal",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='list_pengembalian.php';
                }
              })
        </script>
   <?php }

	include '../footer.php';
?>