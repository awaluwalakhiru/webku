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
                Kategori
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
                        <h5>Daftar Kategori</h5>
                        <a href="tambah_kategori.php" class="btn btn-success btn-sm mb-2">Tambah</a>
                        <div class="table-responsive">
                            <table class="table" id="kategori">
                               <thead class="thead-light">
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id kategori</th>
                                    <th scope="col">Nama kategori</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM kategori");
                                    $i = 1;
                                ?>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($query)):?>
                                    <tr>
                                        <th scope="row"><?= $i++;?></th>
                                        <td><?= $row['id_kategori'];?></td>
                                        <td><?= $row['nama_kategori'];?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="edit_kategori.php?id_kategori=<?= $row['id_kategori'];?>" class="btn btn-info btn-sm mr-2">Edit</a><a href="hapus_kategori.php?id_kategori=<?= $row['id_kategori'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapusnya?')">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile;?>
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
            confirmButtonText: 'ya'
            }).then((result) => {
            if (result.value) {
                e.preventDefault();
                window.location.href = "../auth/keluar.php";
            }
            })
    });
        $("#kategori").DataTable();
    });
</script>