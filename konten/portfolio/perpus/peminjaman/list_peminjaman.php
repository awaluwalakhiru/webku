<?php
    require_once '../proses/koneksi.php';
    include("../header.php");
    if (!isset($_SESSION['user'])) {
        header('location: ../auth/masuk.php');
        exit();
    }
    
    $q = "SELECT pinjam.*, pinjam.id_pinjam, buku.id_buku , buku.judul_buku, anggota.nama_anggota, kembali.id_kembali, kembali.tanggal_kembali FROM pinjam JOIN buku ON buku.id_buku = pinjam.id_buku JOIN anggota ON anggota.id_anggota = pinjam.id_anggota JOIN kembali ON kembali.id_pinjam = pinjam.id_pinjam
        ";
    $query = mysqli_query($conn, $q);
    $hasil = [];
    while ($row = mysqli_fetch_assoc($query)) {
       $hasil[] = $row;
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
                        <h5>Daftar Peminjaman</h5>
                        <?php  
                            // Check message ada atau tidak
                            if(!empty($_SESSION['messages'])) {
                                echo $_SESSION['messages']; //menampilkan pesan 
                                unset($_SESSION['messages']); //menghapus pesan setelah refresh
                            }
                        ?>
                        <a href="tambah_peminjaman.php" class="btn btn-success btn-sm mb-2">Peminjaman</a>
                        <div class="table-responsive">
                            <table class="table" id="peminjaman">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul buku</th>
                                        <th scope="col">Nama anggota</th>
                                        <th scope="col">Tanggal pinjam</th>
                                        <th scope="col">Tanggal jatuh tempo</th>
                                        <th scope="col">Tanggal kembali</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($hasil as $data):?>
                                    <tr>
                                        <th scope="row"><?= $i++;?></th>
                                        <td><?= $data['judul_buku'];?></td>
                                        <td><?= $data['nama_anggota'];?></td>
                                        <td><?= date('d-M-Y',strtotime($data['tanggal_pinjam']));?></td>
                                        <td><?= date('d-M-Y',strtotime($data['tanggal_jatuh_tempo']));?></td>
                                        <td class="text-center"><?php 
                                            if (empty($data['tanggal_kembali'])) {
                                                echo"-";
                                            } else {
                                                echo date('d-M-Y',strtotime($data['tanggal_kembali']));
                                            };?></td>
                                        <td>
                                            <?php 
                                                $status = "";
                                                if (empty($data['tanggal_kembali'])) {
                                                   $status = "masih dipinjam";
                                                   echo "$status";
                                                } else {
                                                    $status = 'sudah dikembalikan';
                                                    echo "$status";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?php if (empty($data['tanggal_kembali'])) :?>
                                                    <a href="../pengembalian/pengembalian.php?id_pinjam=<?= $data['id_pinjam'];?>" class="btn btn-info mr-2 btn-sm" title="Klik untuk proses pengembalian">Pengembalian</a>
                                                    <a href="edit_peminjaman.php?id_pinjam=<?= $data['id_pinjam'];?>&&status=<?= $status;?>" class="btn btn-info mr-2 btn-sm">Edit</a>
                                                <?php endif;?>
                                                <a href="hapus_peminjaman.php?id_pinjam=<?= $data['id_pinjam'];?>&&status=<?= $status;?>&&id_buku=<?= $data['id_buku'];?>" class="btn btn-danger btn-sm" id="hapus" onclick="return confirm('Anda yakin akan menghapusnya?')">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
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
    $('#peminjaman').DataTable();
</script>