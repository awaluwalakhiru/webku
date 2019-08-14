<?php
    require_once '../proses/koneksi.php';
     if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }
    include("../header.php");

    $id_pinjam = $_GET['id_pinjam'];
    $q = "SELECT anggota.nama_anggota, buku.*, pinjam.* FROM pinjam 
    LEFT JOIN buku ON pinjam.id_buku = buku.id_buku 
    LEFT JOIN anggota ON pinjam.id_anggota = anggota.id_anggota
    WHERE pinjam.id_pinjam = $id_pinjam";

    $hasil = mysqli_query($conn, $q);
    $data_pinjam = mysqli_fetch_assoc($hasil);
    $tanggal_kembali = date('Y-m-d');

    $denda = denda($tanggal_kembali, $data_pinjam['tanggal_jatuh_tempo']);

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
                        <h5>Tambah Pengembalian</h5>
                        <?php  
                            // Check message ada atau tidak
                            if(!empty($_SESSION['messages'])) {
                                echo $_SESSION['messages']; //menampilkan pesan 
                                unset($_SESSION['messages']); //menghapus pesan setelah refresh
                            }
                        ?>
                        <form action="proses_pengembalian.php" method="post">
                            <div class="form-group col-md-6">
                                <input type="hidden" name="id_pinjam" value="<?= $data_pinjam['id_pinjam'] ?>">
                                <input type="hidden" name="tanggal_kembali" value="<?= $tanggal_kembali ?>">
                                <input type="hidden" name="denda" value="<?= $denda ?>">
                                <label for="judul_buku">Judul buku</label>
                                <input type="text" value="<?= $data_pinjam['judul_buku']?>" class="form-control" disabled>
                                <small id="teks" class="form-text text-muted">Data ini sesuai database.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_anggota">Nama anggota</label>
                                <input type="text" value="<?= $data_pinjam['nama_anggota']?>" disabled class="form-control">
                                <small class="form-text text-muted">Data ini sesuai database.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_pinjam">Tanggal pinjam</label>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control"  value="<?= $data_pinjam['tanggal_pinjam']?>" disabled>
                                <small class="form-text text-muted">Data ini sesuai database..</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_jatuh_tempo">Tanggal jatuh tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="form-control" value="<?= $data_pinjam['tanggal_jatuh_tempo']?>" disabled>
                                <small class="form-text text-muted">Data ini sesuai database.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_kembali">Tanggal kembali</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?= $tanggal_kembali?>" disabled>
                                <small class="form-text text-muted">Data ini sesuai database.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="denda">Denda</label>
                                <input type="number" name="denda" id="denda" class="form-control" value="<?= $denda?>" disabled>
                                <small class="form-text text-muted">Data ini sesuai database.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <button type="submit" class="btn btn-primary">Kembalikan</button>
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