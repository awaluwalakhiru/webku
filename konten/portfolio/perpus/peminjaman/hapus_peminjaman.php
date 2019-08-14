<?php  
	include '../proses/koneksi.php';
    include '../header.php';
    
    $id_buku = $_GET['id_buku'];
    $id_pinjam = $_GET['id_pinjam'];
    $status = $_GET['status'];

   $stok = stok($conn, $id_buku);

   if ($stok < 1 ) {
       $_SESSION['messages'] = '
       <div class="row">
       <div class="col-md-7">
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Peringatan!</strong> Proses hapus gagal.
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
       </div>
       </div>
     </div>
       ';
       header('location: list_peminjaman.php');
       exit();
   }

   if ($status == 'masih dipinjam') {
       tambah($conn, $id_buku);
   }

   $query = mysqli_query($conn, 'DELETE FROM pinjam WHERE id_pinjam = "$id_pinjam"');

   if ($query) { $_SESSION['messages'] = '
    <div class="row">
    <div class="col-md-7">
    <div class="alert alert-succes alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> Proses hapus data peminjaman sukses.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    </div>
    ';?>
       <script>
             Swal({
                title: 'Status',
                text: "Data peminjaman berhasil dihapus",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='list_peminjaman.php';
                }
              })
       </script>
   <?php } else { $_SESSION['messages'] = '
    <div class="row">
    <div class="col-md-7">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Peringatan!</strong> Proses hapus data peminjaman gagal.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    </div>
    ';?>
        <script>
                Swal({
                    title: 'Status',
                    text: "Data peminjaman gagal dihapus",
                    type: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok'
                }).then((result) => {
                    if (result.value) {
                    window.location.href ='list_peminjaman.php';
                    }
                })
        </script>
   <?php }

	include '../footer.php';
?>