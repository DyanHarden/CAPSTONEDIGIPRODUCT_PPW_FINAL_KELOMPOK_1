<?php
include '../../koneksi.php'; 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../loginadmin.php");
    exit;
}

function hapusArtikel($id_artikel, $conn)
{
    $sql = "DELETE FROM artikel WHERE id_artikel='$id_artikel'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET['hapus_artikel'])) {
    $id_event = $_GET['hapus_artikel'];
    if (hapusArtikel($id_event, $conn)) {
        echo "";
    } else {
        echo "<script>alert('Gagal menghapus event');</script>";
    }
}
$query = "SELECT * FROM artikel";
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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <title>Artikel Admin</title>
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

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
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
                            <a class="nav-link" href="eventrelawan.php" style="color: #5cb874;">
                                <span data-feather="globe"></span>
                                Event Relawan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="artikeladmin.php" style="color: #5cb874;">
                                <span data-feather="trello"></span>
                                Artikel
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

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

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Pengelolaan Artikel</h1>
                <a class="nav-link px-3 border" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a>
            </div>

            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-success">
                            <div class="card-header bg-light text-black" style="background-color: #5cb874;">
                                <h2 class="text-center mb-0">Tambah Artikel</h2>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="crudadmin/tambahevent.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul Artikel</label>
                                        <input type="text" class="form-control" id="judul" name="judul">
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Body</label>
                                        <input id="body" type="hidden" name="body">
                                        <trix-editor input="body"></trix-editor>
                                        <div id="error-msg" class="text-danger" style="display: none;">Body tidak boleh kosong!</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <input type="hidden" name="id_admin" value="<?= $_SESSION['admin_id'] ?>">
                                    <button type="submit" class="btn btn-success">Buat Artikel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel daftar event -->
            <div class="table-responsive">
                <h2 class="mt-5 mb-3 text-center">Daftar Artikel</h2>
                <table class="table table-striped table-bordered border-success">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th>Status Artikel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['judul'] . "</td>";
                                echo "<td>" . $row['isi'] . "</td>";
                                echo "<td><img src='../../assets/img/" . $row['gambar'] . "' alt='Gambar Artikel' style='max-width: 100px; height: auto;'></td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>";
                                if ($row['status'] == 'Menunggu') {
                                    echo "<a href='kelolaartikel.php?id=" . $row['id_artikel'] . "' class='btn btn-success me-2 mb-2'>Terima</a>";
                                }
                                echo "<a href='#' onclick='confirmDelete(" . $row['id_artikel'] . ")' class='btn btn-danger me-2 mb-2'>Hapus</a>";
                                echo "<a href='crudadmin/editartikel.php?id=" . $row['id_artikel'] . "' class='btn btn-primary mb-2'>Edit</a>";
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
                title: 'Hapus Artikel?',
                text: 'Apakah Anda yakin ingin menghapus artikel ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?hapus_artikel=' + id;
                }
            })
        }
    </script>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>
