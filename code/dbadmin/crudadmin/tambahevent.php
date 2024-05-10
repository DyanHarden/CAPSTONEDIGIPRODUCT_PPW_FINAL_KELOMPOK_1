<?php
session_start();
// Include file koneksi database
include '../../../koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../loginadmin.php");
    exit;
}

function image_handler()
{
    $namaFile = $_FILES["image"]["name"];
    $ukuranFile = $_FILES["image"]["size"];
    $locationfile = $_FILES["image"]["tmp_name"];
    $ekstensiGambarValid = ["jpeg", "jpg", "png"];
    $ektensiGambar = explode(".", $namaFile);
    $ektensiGambar = strtolower(end($ektensiGambar));

    if (!in_array($ektensiGambar, $ekstensiGambarValid)) {
        echo "Ekstensi gambar tidak sesuai";
        return false;
    }
    if ($ukuranFile >= 5000000) {
        echo "Ukuran gambar terlalu besar";
        return false;
    }

    $namaFileBaru = uniqid() . "." . $ektensiGambar;
    move_uploaded_file($locationfile, "C:/xampp/htdocs/GreenPA/assets/img/" . $namaFileBaru);
    return $namaFileBaru;
}

// Handle upload gambar
$namaFileBaru = image_handler();

// Jika upload gambar berhasil
if ($namaFileBaru) {
    // Data untuk dimasukkan ke database
    $judul = $_POST['judul'];
    $isi = $_POST['body'];
    $id = $_POST['id_admin'];

    // Query untuk memasukkan data ke dalam tabel artikel
    $query = "INSERT INTO artikel (judul, isi, gambar, id_akun) VALUES ('$judul', '$isi', '$namaFileBaru', '$id')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Artikel berhasil ditambahkan";
        header("Location: ../artikeladmin.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "Upload gambar gagal";
    header("Location: ../artikeladmin.php");
}
