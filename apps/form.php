<?php
include '../main.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = new Server();
    if (isset($_POST['judul_buku'], $_POST['pengarang'], $_POST['penerbit'], $_POST['tahun_terbit'])) {
        $judul = $_POST['judul_buku'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];

        if (!empty($judul) && !empty($pengarang) && !empty($penerbit) && !empty($tahun_terbit)) {
            $server->tambahkan_data_buku($judul, $pengarang, $penerbit, (int)$tahun_terbit);
            header("location: /htdocs/UAS/html/tambah_data_buku.html");
            exit();
        } else {
            echo "Semua kolom harus diisi.";
        }
    } else {
        echo "Data tidak lengkap.";
    }
}
