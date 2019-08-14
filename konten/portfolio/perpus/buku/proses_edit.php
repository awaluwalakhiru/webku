<?php  
	include '../proses/koneksi.php';
    include '../header.php';
    
    $id = $_POST['id_buku'];
    $judul = $_POST['judul_buku'];
    $deskripsi = $_POST['deskripsi_buku'];
    $jumlah = $_POST['jumlah_buku'];
    $kategori = $_POST['id_kategori'];

    $qCover = mysqli_query($conn, "SELECT cover_buku FROM buku WHERE id_buku = '$id'");
    $hasil = mysqli_fetch_assoc($qCover);
    $cover_lama = $hasil['cover_buku'];

    if (!empty($_FILES['cover_buku']['tmp_name'])) {
        $file = $_FILES['cover_buku']['tmp_name'];
        $namaFile = $_FILES['cover_buku']['name'];
        $tujuan = "unggah/".$namaFile;

        $cover_baru = $namaFile;
    } else {
        $cover_baru = $cover_lama;
    }

    $query = "UPDATE buku SET judul_buku = '$judul', deskripsi_buku = '$deskripsi', jumlah_buku = '$jumlah', cover_buku = '$cover_baru', id_kategori = '$kategori' WHERE id_buku = '$id' ";
    $hasil_edit = mysqli_query($conn, $query);

    if ($hasil_edit) {

        if (!empty($_FILES['cover_buku']['tmp_name'])) {
            unlink("unggah/".$cover_lama);
            move_uploaded_file($file, $tujuan);
        }?>
            <script>
                // alert('Unggah dan edit data buku berhasil');
                // window.location.href = 'list_buku.php';
                Swal({
                    title: 'Status',
                    text: "Unggah dan edit data buku berhasil",
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok'
                  }).then((result) => {
                    if (result.value) {
                      window.location.href = 'list_buku.php';
                    }
                  })
            </script>
    <?php } else { ?>
            <script>
                // alert('Unggah dan edit data buku gagal');
                // window.location.href = 'list_buku.php';
                Swal({
                    title: 'Status',
                    text: "Unggah dan edit data buku gagal",
                    type: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok'
                  }).then((result) => {
                    if (result.value) {
                      window.location.href = 'list_buku.php';
                    }
                  })
            </script>
    <?php }

	include '../footer.php';
?>