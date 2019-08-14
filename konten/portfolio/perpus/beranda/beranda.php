<?php
    require_once '../proses/koneksi.php';
    if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }
    $user = $_SESSION['user']['password'];
    $query = mysqli_query($conn, "SELECT * FROM petugas WHERE password = '$user'");
    $hasil = mysqli_fetch_assoc($query);
    include("../header.php");
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand h1 mx-auto">Sistem Informasi Perpustakaan</span>
    </nav>
    <!-- card -->
    <div class="container pt-5 pb-5">
        <div class="card mx-auto">
            <div class="card-header text-center">
                Beranda
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
                        <h4>Selamat datang, <?= $hasil['nama_petugas'];?></h4>
                        <div class="accordion pt-2" id="accordionExample">
                            <div class="card akordion">
                                <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Intermezzo silahkan diklik #
                                    </button>
                                </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Assalamu'allaikum warahmatullahi wabarakatuh, saat ini anda sedang memasuki aplikasi buatan saya yang sederhana. Sekiranya berkenan anda dapat menghubungi saya di <i><b><strong>WA 08562671113</strong></b></i>  atau via <i><b><strong>EMAIL awalprasetyo4@gmail.com</strong></b></i>. Terima kasih telah berkunjung</p>
                                </div>
                                </div>
                            </div>
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
    <footer class="navbar bg-dark d-flex justify-content-center"">
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
</script>