<?php
    require '../proses/koneksi.php';
    require "../header.php";

        $username =  strtolower(trim(htmlspecialchars($_POST['username'])));
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if ($password === $password2) { ?>
                <!-- <script>
                   alert('Password dan konfirmasi password anda sesuai.');
                </script> -->
                <?php
                    $cek = "SELECT username FROM petugas WHERE username = '$username'";
                    $qCek = mysqli_query($conn, $cek);
                    $hasil = mysqli_fetch_assoc($qCek);

                    if ( $hasil['username'] == $username ) { ?>
                            <script>
                                // alert('Username telah terdaftar pilih yang lain.');
                                // window.location.href = '../index.php';
                                Swal({
                                  title: 'Status',
                                  text: "Username telah terdaftar pilih yang lain",
                                  type: 'warning',
                                  showCancelButton: false,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'ok'
                                }).then((result) => {
                                  if (result.value) {
                                    window.location.href ='../index.php';
                                  }
                                })
                            </script>        
                        <?php  } else { ?>
                                    <!-- <script>
                                        alert('Username belum terdaftar bisa dipakai.')
                                    </script> -->
                                    <?php
                                        $username = strtolower(stripslashes($username));
                                        $password = password_hash($password, PASSWORD_DEFAULT);

                                        $q = "INSERT INTO petugas VALUES ('','$username','$username','$password')";
                                        $query = mysqli_query($conn, $q);

                                        if ($query) { ?>
                                                    <script>
                                                        // alert('Data petugas berhasil ditambahkan.');
                                                        // window.location.href = 'masuk.php';
                                                        Swal({
                                                          title: 'Status',
                                                          text: "Data petugas berhasil ditambahkan",
                                                          type: 'success',
                                                          showCancelButton: false,
                                                          confirmButtonColor: '#3085d6',
                                                          cancelButtonColor: '#d33',
                                                          confirmButtonText: 'ok'
                                                        }).then((result) => {
                                                          if (result.value) {
                                                            window.location.href ='masuk.php';
                                                          }
                                                        })
                                                    </script>
                                       <?php } else { ?>
                                                    <script>
                                                        // alert('Data petugas gagal ditambahkan.');
                                                        // window.location.href.href = '../index.php';
                                                        Swal({
                                                          title: 'Status',
                                                          text: "Data petugas gagal ditambahkan",
                                                          type: 'error',
                                                          showCancelButton: false,
                                                          confirmButtonColor: '#3085d6',
                                                          cancelButtonColor: '#d33',
                                                          confirmButtonText: 'ok'
                                                        }).then((result) => {
                                                          if (result.value) {
                                                            window.location.href ='../index.php';
                                                          }
                                                        })
                                                    </script>
                                       <?php }
                        }

        } else { ?>
                <script>
                    // alert('Password dan konfirmasi password tidak sesuai.');
                    // window.location.href = '../index.php';
                    Swal({
                      title: 'Status',
                      text: "Password dan konfirmasi password tidak sesuai",
                      type: 'warning',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ok'
                    }).then((result) => {
                      if (result.value) {
                        window.location.href ='../index.php';
                      }
                    })
                 </script>
        <?php }
    require "../footer.php";
?>