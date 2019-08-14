<?php
    date_default_timezone_set('Asia/Jakarta');
    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "perpus";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Koneksi gagal error: ".mysqli_connect_error());
    }
    
    function base($url= null){
        $base = "http://localhost/latihan/webku/konten/portfolio/perpus";
        if ($url != null) {
            return $base."/".$url;
        } else {
            return $base."/";
        }
    }

     function denda($kembali, $tempo){
        if (strtotime($kembali) > strtotime($tempo)) {
            
            $kembali = new DateTime($kembali);
            $tempo = new DateTime($tempo);

            $selisih = $kembali->diff($tempo);
            $selisih = $selisih->format("%d");

            $denda = $selisih * 2000;

        } else {
            $denda = 0;
        }

        return $denda;
    }

    function stok($conn, $id){
        $q = "SELECT * FROM buku WHERE id_buku = '$id' ";
        $query = mysqli_query($conn, $q);
        $hasil = mysqli_fetch_assoc($query);
        $stok = $hasil['jumlah_buku'];
        return $stok;
    }

    function kurangi($conn, $id){
        $q = "UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id_buku = '$id'";
        mysqli_query($conn, $q);
    }

    function tambah($conn, $id){
        $q = "UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id_buku = '$id'";
        mysqli_query($conn, $q);
    }
    
?>