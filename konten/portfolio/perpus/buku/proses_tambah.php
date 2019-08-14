<?php  
	include '../proses/koneksi.php';
	include '../header.php';
    
    $nama = $_POST['nama_kategori'];
    $judul = htmlspecialchars($_POST['judul_buku']);
    $deskripsi = htmlspecialchars($_POST['deskripsi_buku']);
    $jumlah = htmlspecialchars($_POST['jumlah_buku']);

    $file = $_FILES['cover_buku']['tmp_name'];
    $namaFile = $_FILES['cover_buku']['name'];
    $tujuan = getcwd()."/unggah/".$namaFile;

    $cek = "SELECT * FROM buku WHERE judul_buku = '$judul'";
    $qCek = mysqli_query($conn, $cek);
    $hasil = mysqli_fetch_assoc($qCek);

    if ($hasil['judul_buku'] == $judul) { ?>
        <script>
            // alert('Judul buku telah ada mohon diganti');
            // window.location.href = 'tambah_buku.php';
            Swal({
                title: 'Status',
                text: "Judul buku telah ada mohon diganti",
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'tambah_buku.php';
                }
              })
        </script>
    <?php } else {
        $q = "INSERT INTO buku VALUES ('','$judul','$deskripsi','$jumlah','$namaFile','$nama')";
        $query = mysqli_query($conn, $q);

        if ($query) {
            copy($file, $tujuan);?>
            <script>
                // alert('Anda berhasil tambah data dan upload');
                // window.location.href = 'list_buku.php';
                Swal({
                    title: 'Status',
                    text: "Anda berhasil menambah dan unggah data",
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
                // alert('Anda gagal tambah data dan upload');
                // window.location.href = 'tambah_buku.php';
                Swal({
                    title: 'Status',
                    text: "Anda gagal menambah dan unggah data",
                    type: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ok'
                  }).then((result) => {
                    if (result.value) {
                      window.location.href = 'tambah_buku.php';
                    }
                  })
            </script>
        <?php }
    }

	include '../footer.php';
?>