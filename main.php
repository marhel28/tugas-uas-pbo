<?php
class server
{
    public $koneksi;
    public $denda = 0;

    public function __construct()
    {
        $this->koneksi = new mysqli("localhost", "root", "", "perpustakaan");

    }

    public function tambahkan_data_buku($judul, $pengarang, $penerbit, $tahun_terbit)
    {
        $id_random = random_int(100000, 999999);
        $sql = "INSERT INTO buku (id,judul, pengarang, penerbit, tahun_terbit) VALUES ('$id_random','$judul', '$pengarang', '$penerbit', '$tahun_terbit')";
        if ($this->koneksi->query($sql) === TRUE) {
            echo "data telah ditambahkan";
        } else {
            echo('gagal');
        }
    }

    public function tambah_mahasiswa($nim, $nama, $alamat, $telepon)
    {
        $sql = "INSERT INTO mahasiswa(nim,nama,alamat,telepon) VALUES ('$nim','$nama','$alamat','$telepon')";
        if ($this->koneksi->query($sql) === TRUE) {
            echo "data telah ditambahkan";
        } else {
            echo('gagal');
        }
    }

    public function pengembalian($id_buku, $id_mahasiswa){
        $waktu_pengembalian = date("Y-m-d");
        $sql = "SELECT * FROM `pengembalian` WHERE buku_id = '$id_buku' AND mahasiswa_id = '$id_mahasiswa'";
        $result = $this->koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tanggal_pinjam = $row['tanggal_pinjam'];
            $tanggal_kembali_max = $row['tanggal_kembali_max'];
            if($waktu_pengembalian > $tanggal_kembali_max){
                $selisih_hari = (strtotime($waktu_pengembalian) - strtotime($tanggal_kembali_max))/(60*60*24);
                $denda = $selisih_hari * 2000;
            }
            $buku = $this->buku_base($id_buku);
            $mahasiswa = $this->mahasiswa_base($id_mahasiswa);
            echo "<h1>Nama peminjam :".$mahasiswa['nama']."</h1>";
            echo "<h1>no telephone :".$mahasiswa['telepon']."</h1>";
            echo "<h1>Judul buku :".$buku['judul']."</h1>";
            echo "<h1>Tanggal peminjaman :".$tanggal_pinjam."</h1>";
            echo "<h1>Tanggal kembali :".$waktu_pengembalian."</h1>";
            echo "<h1>Denda :".$denda."</h1>";

        } else {
            echo "tidak ada peminjaman yang ditemukan";
        }
    }
    public function mahasiswa_base($id_mahasiswa){
        $sql = "SELECT * FROM mahasiswa WHERE nim = '$id_mahasiswa'";
        $result = $this->koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else{
            return null;
        }
    }
    public function buku_base ($id_buku){
        $sql = "SELECT * FROM buku WHERE id = '$id_buku'";
        $result = $this->koneksi->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else{
            return null;
        }
    }
}







