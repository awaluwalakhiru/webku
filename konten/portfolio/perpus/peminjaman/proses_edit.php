<?php  
	include '../proses/koneksi.php';
	include '../header.php';

    $id_pinjam = $_POST['id_pinjam'];
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];

    $stok = stok($conn, $id_buku);
    if ($stok < 1) {
        $_SESSION['messages'] = '
        <div class="row">
        <div class="col-md-7">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Peringatan!</strong> Stok buku sudah habis.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
      </div>';
        header('Location: edit_peminjaman.php?id_pinjam='.$id_pinjam);
        exit();
    }

    // ambil data pinjam yang sudah ada
    $q = "SELECT buku.judul_buku, buku.id_buku, pinjam.id_pinjam, pinjam.id_anggota FROM pinjam
                JOIN buku ON buku.id_buku = pinjam.id_buku
                WHERE (pinjam.id_buku = '$id_buku' AND pinjam.id_anggota = '$id_anggota') ";
    $hasil_check = mysqli_query($conn, $q);
    $data = mysqli_fetch_assoc($hasil_check);

    if (count($data['id_pinjam']) > 0 && $id_pinjam != $data['id_pinjam']) {
        $_SESSION['messages'] = '
        <div class="row">
        <div class="col-md-7">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Peringatan!</strong> anggota dengan id '.$data['id_anggota'].' sudah meminjam buku '.$data['judul_buku'].' ini!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        </div>
        ';
        
        header('Location: edit_peminjaman.php?id_pinjam='.$id_pinjam);
        exit();
    }

    $query = "UPDATE pinjam 
			SET 
				id_buku = '$id_buku', 
				id_anggota = '$id_anggota', 
				tanggal_pinjam = '$tanggal_pinjam', 
				tanggal_jatuh_tempo = '$tanggal_jatuh_tempo'
			WHERE
				id_pinjam = '$id_pinjam'";

    $hasil = mysqli_query($conn, $query);

    if ($hasil) {

        kurangi($conn, $id_buku);
        // Mengurangi stok buku
        
        $_SESSION['messages'] = '<div class="row">
        <div class="col-md-7">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> proses edit berhasil.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        </div>';?>
        <script>
             Swal({
                title: 'Status',
                text: "Data peminjaman berhasil diedit",
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
    <?php } else {
        $_SESSION['messages'] = '<div class="row">
        <div class="col-md-7">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> proses edit gagal.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        </div>';?>
        <script>
             Swal({
                title: 'Status',
                text: "Data peminjaman gagal edit",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href ='edit_peminjaman.php?id_pinjam='+<?= $id_pinjam;?>;
                }
              })
        </script>
     <?php }

	include '../footer.php';
?>