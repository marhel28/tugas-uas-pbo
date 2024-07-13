<?php
include '../main.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $server = new Server();
    if(isset($_POST['id_mahasiswa'],$_POST['id_buku'])){
        $id_mahasiswa = $_POST['id_mahasiswa'];
        $id_buku = $_POST['buku_id'];
        if(!empty($id_mahasiswa) && !empty($id_buku)){
            $server->pengembalian($id_buku,$id_mahasiswa);
        }
    }
}