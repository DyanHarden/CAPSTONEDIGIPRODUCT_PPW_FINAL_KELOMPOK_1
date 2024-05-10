<?php
require '../../koneksi.php';

session_start();

$id = $_GET['id'];
$query = "UPDATE artikel SET STATUS = 'Disetujui' WHERE id_artikel = $id";

mysqli_query($conn, $query);
header('Location: artikeladmin.php');
