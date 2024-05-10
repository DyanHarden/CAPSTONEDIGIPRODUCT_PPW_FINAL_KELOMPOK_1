<?php
session_start();
include '../../koneksi.php'; // Pastikan ini sudah ada di awal file

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../loginadmin.php");
    exit;
}

// Fungsi untuk menambah event baru
function tambahEvent($judul, $deskripsi, $tanggal, $tempat, $conn)
{
    $sql = "INSERT INTO event (judul, deskripsi, tanggal, tempat) VALUES ('$judul', '$deskripsi', '$tanggal', '$tempat')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengambil semua event
function semuaEvent($conn)
{
    $sql = "SELECT * FROM event";
    $result = $conn->query($sql);
    return $result;
}

// Fungsi untuk menghapus event
function hapusEvent($id_event, $conn)
{
    $sql = "DELETE FROM event WHERE id_event='$id_event'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Fungsi tambah event
if (isset($_POST['tambah_event'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $tempat = $_POST['tempat'];

    if (tambahEvent($judul, $deskripsi, $tanggal, $tempat, $conn)) {
        echo "<script></script>";
    } else {
        echo "<script>alert('Gagal menambahkan event');</script>";
    }
}

// Fungsi hapus event
if (isset($_GET['hapus_event'])) {
    $id_event = $_GET['hapus_event'];
    if (hapusEvent($id_event, $conn)) {
        echo "<script></script>";
    } else {
        echo "<script>alert('Gagal menghapus event');</script>";
    }
}

// Ambil semua event dari database
$query = "SELECT * FROM event";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Event</title>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fst-italic" href="#" style="background-color: #5cb874;">Green Culture</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="dashboardadmin.php" style="color: #5cb874;">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="eventrelawan.php" style="color: #5cb874;">
                                <span data-feather="globe"></span>
                                Event Relawan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="artikeladmin.php" style="color: #5cb874;">
                                <span data-feather="trello"></span>
                                Artikel
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Exit Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to exit?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="../logoutadmin.php" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Pengelolaan Event Relawan Green Culture</h1>
                    <a class="nav-link px-3 border" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a>
                </div>

                <!-- Form tambah event -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card mt-3 mb-5">
                                <div class="card-body">
                                    <h2 class="text-center">Tambah Event</h2>
                                    <form method="POST">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul Event</label>
                                            <input type="text" class="form-control" id="judul" name="judul">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempat" class="form-label">Tempat</label>
                                            <input type="text" class="form-control" id="tempat" name="tempat">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="tambah_event">Tambah Event</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Tabel daftar event -->
                <div class="table-responsive">
                    <h2 class="mt-4 mb-3 text-start">Daftar Event</h2>
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Tempat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP loop to populate the table with event data -->
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['judul'] . "</td>";
                                    echo "<td>" . $row['deskripsi'] . "</td>";
                                    echo "<td>" . $row['tanggal'] . "</td>";
                                    echo "<td>" . $row['tempat'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='../kelolaevent.php?id=" . $row['id_event'] . "' class='btn btn-success me-2 mb-2'>Kelola</a>";
                                    echo "<a href='#' onclick='confirmDelete(" . $row['id_event'] . ")' class='btn btn-danger me-2 mb-2'>Hapus</a>"; // Ubah link ke event onclick
                                    echo "<a href='crudadmin/editevent.php?id=" . $row['id_event'] . "' class='btn btn-primary mb-2'>Edit</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada event.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <footer class="bg-body-tertiary text-center text-lg-start text-light mt-5">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #5cb874;">
            © 2024 Copyright:
            <a class="text-light" href="">GreenCulture.com</a>
        </div>
        <!-- Copyright -->
    </footer>


    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Event?',
                text: 'Apakah Anda yakin ingin menghapus event ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?hapus_event=' + id;
                }
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>