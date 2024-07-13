<?php
include '../main.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $server = new Server();

    if (isset($_POST['nama'], $_POST['alamat'], $_POST['no_telp'], $_POST['nim'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $nim = $_POST['nim'];

        if (!empty($nama) && !empty($alamat) && !empty($no_telp) && !empty($nim)) {
            $server->tambah_mahasiswa((int)$nim, $nama, $alamat, $no_telp);

            // Redirect setelah data ditambahkan
            header("location: /htdocs/UAS/html/tambah_mahasiswa.html");
            exit();
        } else {
            echo "Semua kolom harus diisi.";
        }
    } else {
        echo "Data tidak lengkap.";
    }
}