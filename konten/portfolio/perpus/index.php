<?php
    require_once 'proses/koneksi.php';
    include("header.php");
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand h1 mx-auto">Sistem Informasi Perpustakaan</span>
    </nav>
    <!-- card -->
    <div class="container pt-5 pb-5">
    <div class="card mx-auto">
            <div class="card-header text-center">
                Registrasi
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Halaman Registrasi</h5>
                <form action="auth/proses_daftar.php" method="post">
                    <div class="form-group row">
                        <label for="username" class="col-sm-12 col-md-3 offset-md-1 col-form-label">Username</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-12 col-md-3 offset-md-1 col-form-label">Password</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password2" class="col-sm-12 col-md-3 offset-md-1 col-form-label">Konfirmasi
                            Password</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col col-md-3 offset-md-4">
                            <a href="auth/masuk.php" class="btn btn-primary">Masuk</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                        </div>
                    </div>
                </form>
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
    include ("footer.php");
?>