<?php
    require_once '../proses/koneksi.php';
     if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }
    include("../header.php");

    $qK = "SELECT buku.*, kategori.nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori";
    $queryK = mysqli_query($conn, $qK);
    $hasil_K = [];
    while ($rowK = mysqli_fetch_assoc($queryK)) {
        $hasil_K[] = $rowK;
    }

    $qA = "SELECT * FROM anggota";
    $queryA = mysqli_query($conn, $qA);
    $hasil_A =[];
    while ($rowA = mysqli_fetch_assoc($queryA)) {
        $hasil_A[] = $rowA;
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
               Peminjaman
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
                        <h5>Tambah Peminjaman</h5>
                        <?php  
                            // Check message ada atau tidak
                            if(!empty($_SESSION['messages'])) {
                                echo $_SESSION['messages']; //menampilkan pesan 
                                unset($_SESSION['messages']); //menghapus pesan setelah refresh
                            }
                        ?>
                        <form action="proses_tambah.php" method="post">
                            <div class="form-group col-md-6">
                                <label for="judul_buku">Judul buku</label>
                                <select id="judul_buku" class="form-control" name="id_buku" required autofocus>
                                    <?php foreach($hasil_K as $buku) :?>
                                        <option value="<?= $buku['id_buku'];?>"><?= $buku['judul_buku']?></option>
                                    <?php endforeach;?>
                                </select>
                                <small id="teks" class="form-text text-muted">Judul buku akan tersimpan.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_anggota">Nama anggota</label>
                                <select id="judul_buku" class="form-control" name="id_anggota" required>
                                    <?php foreach($hasil_A as $anggota) :?>
                                        <option value="<?= $anggota['id_anggota'];?>"><?= $anggota['nama_anggota']?></option>
                                    <?php endforeach;?>
                                </select>
                                <small class="form-text text-muted">Pastikan data yang anda masukkan benar.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_pinjam">Tanggal pinjam</label>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                                <small class="form-text text-muted">Jangan lupa diisi.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_jatuh_tempo">Tanggal jatuh tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="form-control" required>
                                <small class="form-text text-muted">Isikan data yang sesuai.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <button type="submit" class="btn btn-primary" name="tambah">Tambah data</button>
                            </div>
                        </form>
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
    <footer class="navbar bg-dark d-flex justify-content-center"">
        <span class=" text-light">Created by Awal
        Prasetyo &copy; 2018</span>
    </footer>
<?php
    include ("../footer.php");
?>

<script>
    $(document).ready(function(){
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
            confirmButtonText: 'yes'
            }).then((result) => {
            if (result.value) {
                e.preventDefault();
                window.location.href = "../auth/keluar.php";
            }
            })
    });
    // const hapus = document.getElementById("hapus");
    // hapus.addEventListener('click', function(e){
    //     e.preventDefault();
    //     Swal({
    //         title: 'Anda yakin ingin menghapusnya?',
    //         text: "Data akan segera dihapus",
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'ya'
    //         }).then((result) => {
    //         if (result.value) {
    //             e.preventDefault();
    //             window.location.href = "hapus_anggota.php";
    //         }
    //         })
    // });
        $("#anggota").DataTable();
    });
</script>