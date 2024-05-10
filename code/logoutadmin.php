<?php
// Mulai session
session_start();

// Hancurkan session admin jika sudah ada
if (isset($_SESSION['admin_id'])) {
    // Hapus semua variabel session
    session_unset();

    // Hancurkan session
    session_destroy();

    // Pastikan halaman tidak disimpan di cache
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Redirect ke halaman login admin
    header("Location: loginadmin.php");
    exit;
} else {
    // Redirect ke halaman login admin jika tidak ada session admin
    header("Location: loginadmin.php");
    exit;
}
