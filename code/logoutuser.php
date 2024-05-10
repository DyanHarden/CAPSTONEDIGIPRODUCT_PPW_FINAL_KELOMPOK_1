<?php
// Mulai session
session_start();

// Hancurkan session admin jika sudah ada
if (isset($_SESSION['user_id'])) {
    // Hapus semua variabel session
    session_unset();

    // Hancurkan session
    session_destroy();

    // Redirect ke halaman login admin
    header("Location: loginuser.php");
    exit;
} else {
    // Redirect ke halaman login admin jika tidak ada session admin
    header("Location: loginuser.php");
    exit;
}
