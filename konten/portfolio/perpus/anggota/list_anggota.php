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
                        <h5>Daftar Anggota</h5>
                        <a href="tambah_anggota.php" class="btn btn-success btn-sm mb-2">Tambah</a>
                        <div class="table-responsive">
                            <table class="table" id="anggota">
                               <thead class="thead-light">
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id anggota</th>
                                    <th scope="col">Nama anggota</th>
                                    <th scope="col">Alamat anggota</th>
                                    <th scope="col">Jenis kelamin</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                    $q = "SELECT * FROM anggota";
                                    $query = mysqli_query($conn, $q);
                                    $i = 1;
                                ?>
                                <tbody>
                                <?php while ($hasil = mysqli_fetch_assoc($query)) :?>
                                    <tr>
                                        <th scope="row"><?= $i++;?></th>
                                        <td><?= $hasil['id_anggota'];?></td>
                                        <td><?= $hasil['nama_anggota'];?></td>
                                        <td><?= $hasil['alamat_anggota'];?></td>
                                        <td><?= $hasil['jk_anggota'];?></td>
                                        <td><?= $hasil['hp_anggota'];?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit_anggota.php?id_anggota=<?= $hasil['id_anggota'];?>" class="btn btn-info mr-2 btn-sm">Edit</a>
                                                <a href="hapus_anggota.php?id_anggota=<?= $hasil['id_anggota'];?>" class="btn btn-danger btn-sm" id="hapus" onclick="return confirm('Anda yakin akan menghapusnya?')">Hapus</a>
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

        // const hapus = document.querySelectorAll('#hapus');
        // for (let i = 0; i < hapus.length; i++) {
        //     hapus[i].addEventListener('click', function(e){
        // //         e.preventDefault();
        // //         Swal({
        // //         title: 'Anda yakin ingin menghapusnya?',
        // //         text: "Data akan dihapus",
        // //         type: 'warning',
        // //         showCancelButton: true,
        // //         confirmButtonColor: '#3085d6',
        // //         cancelButtonColor: '#d33',
        // //         confirmButtonText: 'yes'
        // //         }).then((result) => {
        // //         if (result.value) {
        // //             e.preventDefault();
        // //             }
        // //         }
        //         confirm('Anda yakin ingin menghapusnya?');
        //     } );
            
        // }
    
        $("#anggota").DataTable();
</script>