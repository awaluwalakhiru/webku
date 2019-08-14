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
                    <?php  
                        // proses ambil data dari database
                        $id = $_GET['id_pinjam'];
                        $queryP = mysqli_query($conn, "SELECT * FROM pinjam WHERE id_pinjam = '$id'");
                        $hasilP = mysqli_fetch_assoc($queryP);

                        $q = "SELECT buku.*, kategori.nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori";
                        $queryB = mysqli_query($conn, $q);
                        $hasilB = [];
                        while ( $row = mysqli_fetch_assoc($queryB)) {
                            $hasilB[] = $row;
                        }

                        $queryA = mysqli_query($conn, "SELECT * FROM anggota");
                        $hasilA = [];
                        while ($row = mysqli_fetch_assoc($queryA) ) {
                            $hasilA[] = $row;
                        }

                    ?>
                    <div class="col-sm-12 col-md-9">
                        <h5>Edit Peminjaman</h5>
                        <?php  
                            // Check message ada atau tidak
                            if(!empty($_SESSION['messages'])) {
                                echo $_SESSION['messages']; //menampilkan pesan 
                                unset($_SESSION['messages']); //menghapus pesan setelah refresh
                            }
                        ?>
                        <form action="proses_edit.php" method="post">
                            <input type="hidden" value="<?= $id;?>" name="id_pinjam">
                            <div class="form-group col-md-7">
                                <label for="judul_buku">Judul buku</label>
                                <select name="id_buku" id="id_buku" class="form-control" required autofocus>
                                    <?php foreach ( $hasilB as $buku) :?>
                                        <option value="<?= $buku['id_buku'];?>" <?= ($buku['id_buku'] == $hasilP['id_buku'])?'selected':'';?> ><?= $buku['judul_buku'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <small id="teks" class="form-text text-muted">Pilih sesuai yang ada.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="id_anggota">Nama anggota</label>
                                <select name="id_anggota" id="id_anggota" class="form-control" required>
                                    <?php foreach ( $hasilA as $anggota) :?>
                                        <option value="<?= $anggota['id_anggota'];?>" <?= ($anggota['id_anggota'] == $hasilP['id_anggota'])?'selected':'';?> ><?= $anggota['nama_anggota'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <small class="form-text text-muted">Pastikan data yang anda pilih benar.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="tanggal_pinjam">Tanggal pinjam</label>
                                <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam" value="<?= $hasilP['tanggal_pinjam'];?>" required>
                                <small class="form-text text-muted">Jangan lupa diisi.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="tanggal_jatuh_tempo">Tanggal jatuh tempo</label>
                                <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="<?= $hasilP['tanggal_jatuh_tempo'];?>" required>
                                <small class="form-text text-muted">Jangan lupa diisi.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <button type="submit" class="btn btn-primary" name="edit">Edit data</button>
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
    const hapus = document.querySelectorAll('#hapus');
        for (let i = 0; i < hapus.length; i++) {
            hapus[i].addEventListener('click', function(e){
                e.preventDefault();
                Swal({
                title: 'Anda yakin ingin menghapusnya?',
                text: "Data akan dihapus",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'yes'
                }).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    window.location.href = "hapus_anggota.php";
                }
                })

            } );
            
        }
        $("#anggota").DataTable();
    });
</script>