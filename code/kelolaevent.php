<?php
// Mulai session
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    // Jika belum, redirect ke halaman login
    header("Location: ../loginadmin.php");
    exit;
}

// Include file koneksi database
include '../koneksi.php';

// Lakukan query untuk mendapatkan informasi event berdasarkan ID yang diberikan
if (isset($_POST['disetujui'])) {
    $id = $_POST['disetujui'];
    $conn->query("UPDATE daftar_event SET status = 'Disetujui' WHERE id_pendaftaran = $id");
}
if (isset($_POST['ditolak'])) {
    $id = $_POST['ditolak'];
    $conn->query("DELETE FROM daftar_event WHERE id_pendaftaran = $id");
}
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $query = "SELECT * FROM daftar_event WHERE id_event = $event_id AND status = 'Menunggu'";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Tambahkan header sesuai kebutuhan -->
    </header>

    <main>
        <div class="container">
            <h1 class="mt-5 mb-3">Kelola Event</h1>
            <a href="dbadmin/dashboardadmin.php" class="btn btn-success d-inline-block mb-3">Kembali</a>
            <?php while ($data = mysqli_fetch_array($result)) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <!-- Tampilkan informasi event di sini -->
                        <h2 class="card-title"><?php echo $data['nama_pendaftar']; ?></h2>
                        <p class="card-text"><?php echo $data['email_pendaftar']; ?></p>
                        <p class="card-text">Status: <?php echo $data['status']; ?></p>

                        <!-- Tombol untuk menyetujui -->
                        <form class="float-end" action="" method="post">
                            <input type="hidden" name="disetujui" value="<?php echo $data['id_pendaftaran']; ?>">
                            <button type="submit" class="btn btn-success ms-1" name="approve">Setujui</button>
                        </form>

                        <!-- Tombol untuk menolak -->
                        <form class="float-end" action="" method="post">
                            <input type="hidden" name="ditolak" value="<?php echo $data['id_pendaftaran']; ?>">
                            <button type="submit" class="btn btn-danger" name="reject">Tolak</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>


    <footer>
        <!-- Tambahkan footer sesuai kebutuhan -->
    </footer>

    <!-- Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>