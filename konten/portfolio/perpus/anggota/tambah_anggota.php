<?php
    require_once '../proses/koneksi.php';
     if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }
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
                Anggota
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
                        <h5>Tambah Anggota</h5>
                        <form action="proses_tambah.php" method="post">
                            <div class="form-group col-md-7">
                                <label for="nama_anggota">Nama anggota</label>
                                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" aria-describedby="teks" placeholder="Masukkan nama anda" required autofocus>
                                <small id="teks" class="form-text text-muted">Nama anda akan tersimpan.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="alamat_anggota">Alamat anggota</label>
                                <input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota" placeholder="Masukkan alamat anda" required>
                                <small class="form-text text-muted">Pastikan data yang anda masukkan benar.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="jk">Jenis kelamin anggota</label>
                                <select class="form-control" id="jk" name="jk_anggota">
                                      <option value="L">Laki-Laki</option>
                                      <option value="P">Perempuan</option>
                                </select>
                                <small class="form-text text-muted">Jangan lupa diisi.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="handphone">Nomor Handphone</label>
                                <input type="number" class="form-control" id="handphone" name="hp_anggota" placeholder="Masukkan nomor HP anda" required>
                                <small class="form-text text-muted">Isikan kontak yang dapat dihubungi.</small>
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
                    $waktu = date("l, d-M-Y ,h:i:s");
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