<?php 
	include '../proses/koneksi.php';
    include '../header.php';

    if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }

    $tanggal_kembali = $_POST['tanggal_kembali'];
    $id_pinjam = $_POST['id_pinjam'];
    $denda = $_POST['denda'];

    $query = mysqli_query($conn, "INSERT INTO kembali VALUES ('','$id_pinjam','$tanggal_kembali','$denda')");
    $num = mysqli_affected_rows($conn);

    if ($num > 0) {
        // ambil buku_id berdasarkan pinjam_id
        $q = "SELECT buku.id_buku FROM buku JOIN pinjam ON buku.id_buku = pinjam.id_buku WHERE pinjam.id_pinjam = $id_pinjam";
        $hasil = mysqli_query($conn, $q);
        $hasil = mysqli_fetch_assoc($hasil);
        $id_buku = $hasil['id_buku'];

        tambah($conn, $id_buku);
        // tambah stok

        $_SESSION['messages'] = '<div class="row">
            <div class="col-md-7">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Status!</strong> proses pengembalian berhasil.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
        </div';?>
        <script>
            // alert('Data peminjaman berhasil ditambahkan');
            // window.location.href = 'list_peminjaman.php';
            Swal({
                title: 'Status',
                text: "Proses pengembalian sukses",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='../peminjaman/list_peminjaman.php';
                }
              })
        </script>
    <?php } else {
        $_SESSION['messages'] = '<div class="row">
            <div class="col-md-7">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Status!</strong> proses pengembalian gagal.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>
        </div';
        header('Location: pengembalian.php?id_pinjam='. $id_pinjam);
    }

	include '../footer.php';
?>