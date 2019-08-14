<?php
    require '../proses/koneksi.php';
    require "../header.php";

        $username = trim(strtolower(htmlspecialchars($_POST['username'])));
        $password = htmlspecialchars($_POST['password']);

        $q = "SELECT username FROM petugas WHERE username = '$username'";
        $query = mysqli_query($conn, $q);
        $hasil = mysqli_fetch_assoc($query);

        if ($hasil['username'] == $username) {?>
                <!-- <script>
                    alert('Anda telah terdaftar dalam sistem kami.');
                </script> -->
            <?php
                $qCek = "SELECT password FROM petugas where username = '$username'";
                $query = mysqli_query($conn, $qCek);
                $hasil = mysqli_fetch_assoc($query);

                $password2 = password_verify($password, $hasil['password']);

                if ($password2) {
                    $_SESSION['user'] = $hasil; ?>
                    <script>
                        // alert('Password yang anda masukkan match.');
                        // window.location.href = '../beranda/beranda.php';
                        Swal({
                          title: 'Status',
                          text: "Password yang anda masukkan match",
                          type: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'ok'
                        }).then((result) => {
                          if (result.value) {
                            window.location.href ='../beranda/beranda.php';
                          }
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        // alert('Password yang anda masukkan tidak match.');
                        // window.location.href = 'masuk.php';
                        Swal({
                          title: 'Status',
                          text: "Password yang anda masukkan tidak match",
                          type: 'error',
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
                <?php }

        } else { ?>
            <script>
                // alert('Anda belum terdaftar dalam sistem kami.');
                // window.location.href = '../index.php';
                Swal({
                      title: 'Status',
                      text: "Anda belum terdaftar dalam sistem kami",
                      type: 'error',
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
        <?php }
        require "../footer.php";
?>