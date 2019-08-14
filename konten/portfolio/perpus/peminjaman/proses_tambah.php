<?php  
	include '../proses/koneksi.php';
    include '../header.php';
    
    $id_buku = htmlspecialchars($_POST['id_buku']);
    $id_anggota = htmlspecialchars($_POST['id_anggota']);
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];

    // cek stok buku
    $stok_buku = stok($conn, $id_buku);

    if ($stok_buku < 1) {
        $_SESSION['messages'] = '<div class="row">
        <div class="col-md-7">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Peringatan!</strong> Stok buku sudah habis, peminjaman gagal.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
      </div>';
        header('Location: tambah_peminjaman.php');
        exit();
    }

    $q = "INSERT INTO pinjam VALUES ('','$id_buku','$id_anggota','$tanggal_pinjam','$tanggal_jatuh_tempo')";
    $query = mysqli_query($conn, $q);
    $num = mysqli_affected_rows($conn);

    if ($num > 0) { 
        
        kurangi($conn, $id_buku);

        $query = mysqli_query($conn, "SELECT id_pinjam FROM pinjam WHERE id_anggota = '$id_anggota'");
        $hasil = mysqli_fetch_assoc($query);
        $id_pinjam = $hasil['id_pinjam'];

        $in = mysqli_query($conn, "INSERT INTO kembali (id_kembali, id_pinjam) VALUES ('','$id_pinjam')");

        $_SESSION['messages'] = '<div class="row">
        <div class="col-md-7"><div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Status!</strong> Peminjaman sukses.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
      </div>';

        ?>
        <script>
            // alert('Data peminjaman berhasil ditambahkan');
            // window.location.href = 'list_peminjaman.php';
            Swal({
                title: 'Status',
                text: "Data peminjaman berhasil ditambahkan",
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
    <?php } else { ?>
       <script>
            // alert('Data peminjaman gagal ditambahkan');
            // window.location.href = 'tambah_peminjaman.php';
            Swal({
                title: 'Status',
                text: "Data peminjaman gagal ditambahkan",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='tambah_peminjaman.php';
                }
              })
        </script>
    <?php }

	include '../footer.php';
?>