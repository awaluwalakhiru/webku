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
                Buku
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
                        $qK = "SELECT * FROM kategori";
                        $query_kategori = mysqli_query($conn, $qK);
                        $hasil_kategori = [];
                        while ($row = mysqli_fetch_assoc($query_kategori) ) {
                            $hasil_kategori[] = $row;
                        }

                        $id = $_GET['id_buku'];
                        $query = mysqli_query($conn, "SELECT buku.*, kategori.id_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE id_buku = '$id'");
                        $hasil = mysqli_fetch_assoc($query);
                    ?>
                    <div class="col-sm-12 col-md-9">
                        <h5>Edit Buku</h5>
                        <form action="proses_edit.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $id;?>" name="id_buku">
                            <div class="form-group col-md-7">
                                <label for="judul_buku">Judul buku</label>
                                <input type="text" class="form-control" id="judul_buku" name="judul_buku" required autofocus value="<?= $hasil['judul_buku'];?>">
                                <small id="teks" class="form-text text-muted">Judul buku anda akan tersimpan.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="deskripsi_buku">Deskripsi buku</label>
                                <textarea name="deskripsi_buku" id="deskripsi_buku" class="form-control" rows="6"><?= $hasil['deskripsi_buku']?></textarea>
                                <small class="form-text text-muted">Pastikan deskripsi buku sesuai dengan isi.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="jumlah_buku">Jumlah buku</label>
                                <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" required value="<?= $hasil['jumlah_buku'];?>">
                                <small class="form-text text-muted">Isikan jumlah buku.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="cover_buku">Sampul buku</label>
                                <input type="file" class="form-control-file" id="cover_buku" name="cover_buku" value="<?= $hasil['cover_buku'];?>">
                                <small class="form-text text-muted">Upload tipe file image / icon thumbnail.</small>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="id_kategori">Nama Kategori</label>
                                <select class="form-control" id="id_kategori" name="id_kategori">
                                    <?php foreach ($hasil_kategori as $k):?>
                                      <option  value="<?= $k['id_kategori']?>" <?= ($hasil['id_kategori'] == $k['id_kategori'])?'selected':'';?>><?= $k['nama_kategori']?></option>
                                    <?php endforeach;?>
                                </select>
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
    // const hapus = document.querySelectorAll('#hapus');
    //     for (let i = 0; i < hapus.length; i++) {
    //         hapus[i].addEventListener('click', function(e){
    //             e.preventDefault();
    //             Swal({
    //             title: 'Anda yakin ingin menghapusnya?',
    //             text: "Data akan dihapus",
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'yes'
    //             }).then((result) => {
    //             if (result.value) {
    //                 e.preventDefault();
    //                 window.location.href = "hapus_anggota.php";
    //             }
    //             })

    //         } );
            
    //     }
        // $("#anggota").DataTable();
    });
</script>