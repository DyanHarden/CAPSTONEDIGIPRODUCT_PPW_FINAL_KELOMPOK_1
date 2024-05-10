<?php
session_start();
include '../../../koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../loginadmin.php");
    exit;
}

if (isset($_GET['id'])) {
    $id_event = $_GET['id'];
    $query = "SELECT * FROM event WHERE id_event='$id_event'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $judul = $row['judul'];
        $deskripsi = $row['deskripsi'];
        $tanggal = $row['tanggal'];
        $tempat = $row['tempat'];
    } else {
        echo "<script>alert('Event tidak ditemukan');</script>";
        header("Location: ../eventrelawan.php"); // Redirect ke halaman daftar event jika event tidak ditemukan
    }
} else {
    echo "<script>alert('ID event tidak valid');</script>";
    header("Location: ../eventrelawan.php"); // Redirect ke halaman daftar event jika ID event tidak valid
}

if (isset($_POST['update_event'])) {
    $judul_baru = $_POST['judul'];
    $deskripsi_baru = $_POST['deskripsi'];
    $tanggal_baru = $_POST['tanggal'];
    $tempat_baru = $_POST['tempat'];

    $query_update = "UPDATE event SET judul='$judul_baru', deskripsi='$deskripsi_baru', tanggal='$tanggal_baru', tempat='$tempat_baru' WHERE id_event='$id_event'";
    if ($conn->query($query_update) === TRUE) {
        echo "<script>alert('Event berhasil diperbarui');</script>";
        header("Location: ../eventrelawan.php"); // Redirect ke halaman daftar event setelah event diperbarui
    } else {
        echo "<script>alert('Gagal memperbarui event');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Document</title>

    <style>
        .container {
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="container d-flex justify-content-center align-items-center vh-100">
                <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Event</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $deskripsi; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?php echo $tempat; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <button type="submit" class="btn btn-primary" name="update_event">Perbarui Event</button>
                                    </div>
                                    <div class="col-md-auto">
                                        <a href="../dashboardadmin.php" class="btn btn-success">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>