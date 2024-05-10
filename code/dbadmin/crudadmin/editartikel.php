<?php
session_start();
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
    // RUBAH LOKASI SESUAI DENGAN LOKASI HOSTING
    move_uploaded_file($locationfile, "C:/xampp/htdocs/GreenPA/assets/img/" . $namaFileBaru);
    return $namaFileBaru;
}

if (isset($_GET['id'])) {
    $id_artikel = $_GET['id'];
    $query = "SELECT * FROM artikel WHERE id_artikel='$id_artikel'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $judul = $row['judul'];
        $isi = $row['isi'];
        $gambar = $row['gambar'];
    } else {
        echo "<script>alert('Event tidak ditemukan');</script>";
        header("Location: ../artikeladmin.php"); // Redirect ke halaman daftar event jika event tidak ditemukan
    }
} else {
    echo "<script>alert('ID event tidak valid');</script>";
    header("Location: ../artikeladmin.php"); // Redirect ke halaman daftar event jika ID event tidak valid
}

if (isset($_POST['update_artikel'])) {
    $judul_baru = $_POST['judul'];
    $isi_baru = $_POST['body'];
    $gambar_baru = image_handler();

    $query_update = "UPDATE artikel SET judul='$judul_baru', isi='$isi_baru', gambar='$gambar_baru' WHERE id_artikel='$id_artikel'";
    if ($conn->query($query_update) === TRUE) {
        echo "<script>alert('Artikel berhasil diperbarui');</script>";
        header("Location: ../artikeladmin.php"); // Redirect ke halaman daftar artikel setelah artikel diperbarui
    } else {
        echo "<script>alert('Gagal memperbarui artikel');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Document</title>

    <style>
        .container {
            margin-top: auto;
            margin-bottom: auto;
        }

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
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
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Artikel</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="body" class="form-label">Body</label>
                                    <input id="body" type="hidden" name="body" value="<?php echo $isi; ?>">
                                    <trix-editor input="body"></trix-editor>
                                    <div id="error-msg" style="color: red; display: none;">Body tidak boleh kosong!</div>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">gambar</label>
                                    <input type="file" class="form-control" id="image" name="image" value="<?php echo $tanggal; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary" name="update_artikel">Perbarui Artikel</button>
                                <a href="../dashboardadmin.php" class="btn btn-success">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>