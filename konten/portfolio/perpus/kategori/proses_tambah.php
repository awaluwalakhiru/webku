<?php
    include '../proses/koneksi.php';
	include '../header.php';

    $nama = htmlspecialchars($_POST['nama_kategori']);
    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori = '$nama'");
    $hasil = mysqli_fetch_assoc($query);

    if ($hasil['nama_kategori'] == $nama) { ?>
        <script>
            // alert('Nama kategori telah ada, masukkan lainnya');
            // window.location.href = 'list_kategori.php';
            Swal({
                title: 'Status',
                text: "Nama kategori telah ada, masukkan lainnya",
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'tambah_kategori.php';
                }
              })
        </script>
    <?php } else {
        
        $nama = trim(stripslashes($nama));
        $q = mysqli_query($conn, "INSERT INTO kategori VALUES ('','$nama')");
        $num = mysqli_affected_rows($conn);

        if ($num > 0) { ?>
            <script>
            Swal({
                title: 'Status',
                text: "Nama kategori telah berhasil ditambahkan",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'list_kategori.php';
                }
              })
            </script>
        <?php } else { ?>
            <script>
            Swal({
                title: 'Status',
                text: "Nama kategori gagal ditambahkan",
                type: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ok'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'tambah_kategori.php';
                }
              })
        <?php }
    }

    include '../footer.php';
?>