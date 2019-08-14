<?php
    require_once '../proses/koneksi.php';
    include("../header.php");
    if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }

    $query = "SELECT buku.judul_buku, pinjam.tanggal_pinjam, pinjam.tanggal_jatuh_tempo,kembali.id_kembali, kembali.tanggal_kembali, anggota.nama_anggota
    FROM pinjam
    JOIN buku ON buku.id_buku = pinjam.id_buku
    JOIN anggota ON anggota.id_anggota = pinjam.id_anggota
    JOIN kembali ON pinjam.id_pinjam = kembali.id_pinjam";

    $hasil = mysqli_query($conn, $query);
    // ... menampung semua data kategori
    $dataK = [];

    // ... tiap baris dari hasil query dikumpulkan ke $data_buku
    while ($row = mysqli_fetch_assoc($hasil)) {
        $dataK[] = $row;
    }
    
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand h1 mx-auto">Sistem Informasi Perpustakaan</span>
    </nav>
    <!-- card -->
    <div class="container pt-5 pb-5">
        <div class="card mx-auto">
            <div class="card-header text-center">
                Pengembalian
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3 pb-3">
                        <div class="btn-group-vertical btn-block">
                            <a href="<?= base();?>beranda/beranda.php" class="btn btn-outline-primary">Beranda</a>
                            <a href="<?= base();?>anggota/list_anggota.php" class="btn btn-outline-primary">Anggota</a>
                            <a href="<?= base();?>buku/list_buku.php" class="btn btn-outline-primary">Buku</a>
                            <a href="<?= base();?>kategori/list_kategori.php" class="btn btn-outline-primary">Kategori</a>
                            <a href="<?= base();?>peminjaman/list_peminjaman.php" class="btn btn-outline-primary">Peminjaman</a>
                            <a href="<?= base();?>pengembalian/list_pengembalian.php" class="btn btn-outline-primary">Pengembalian</a>
                            <a href="<?= base();?>auth/keluar.php" class="btn btn-outline-primary" id="keluar">keluar</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <h5>Daftar Pengembalian</h5>
                        <div class="table-responsive">
                            <table class="table" id="pengembalian">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul buku</th>
                                        <th scope="col">Nama anggota</th>
                                        <th scope="col">Tanggal pinjam</th>
                                        <th scope="col">Tanggal jatuh tempo</th>
                                        <th scope="col">Tanggal kembali</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ( $dataK as $k) :
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $i++;?></th>
                                        <td><?= $k['judul_buku'];?></td>
                                        <td><?= $k['nama_anggota'];?></td>
                                        <td><?= $k['tanggal_pinjam'];?></td>
                                        <td><?= $k['tanggal_jatuh_tempo'];?></td>
                                        <td><?= $k['tanggal_kembali'];?></td>
                                        <td><a href="hapus_pengembalian.php?id_kembali=<?= $k['id_kembali']?>" onclick="return confirm('anda yakin akan menghapus data?')" class="btn btn-danger btn-sm">Hapus</a></td>
                                    </tr>
                                    <?php endforeach ;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted text-center">
                <?php
                    $waktu = date("l, d-M-Y, h:i:s");
                    echo "$waktu";
                ?>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="navbar bg-dark d-flex justify-content-center">
        <span class=" text-light">Created by Awal
        Prasetyo &copy; 2018</span>
    </footer>
<?php
    include ("../footer.php");
?>

<script>
    const keluar = document.getElementById("keluar");
    keluar.addEventListener('click', function(e){
        e.preventDefault();
        Swal({
            title: 'Anda yakin ingin keluar?',
            text: "Anda akan segera keluar",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya'
            }).then((result) => {
            if (result.value) {
                e.preventDefault();
                window.location.href = "../auth/keluar.php";
            }
            })
    });
    $('#pengembalian').DataTable();
</script>