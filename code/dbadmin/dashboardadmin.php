<?php
session_start();

include '../../koneksi.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: ../loginadmin.php");
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Dashboard Admin</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="../../assets/img/favicon-16x16.png" rel="icon" />
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

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


  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fst-italic" href="#" style="background-color: #5cb874;">Green Culture</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
      <!-- <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a> -->
    </div>
    </div>
  </header>

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



  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="" style="color: #5cb874;">
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
              <a class="nav-link" href="artikeladmin.php" style="color: #5cb874;">
                <span data-feather="trello"></span>
                Artikel
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <?php

      ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard Admin</h1>
          <a class="nav-link px-3 border" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a>
        </div>

        <div class="container">
          <h2 class="mt-5 mb-4 text-center">Data Pendaftar Event</h2>
          <div class="table-responsive">
            <table class="table table-bordered table-hover border-success">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Pendaftar</th>
                  <th>Email Pendaftar</th>
                  <th>Nama Event</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Include file koneksi database
                include '../../koneksi.php';

                // Query untuk mengambil semua data dari tabel daftar_event
                $query = "SELECT daftar_event.id_pendaftaran, daftar_event.nama_pendaftar, daftar_event.email_pendaftar, event.judul, daftar_event.status FROM daftar_event JOIN event ON daftar_event.id_event = event.id_event";
                $result = $conn->query($query);
                $i = 1;

                // Jika data ditemukan, tampilkan ke dalam tabel
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['nama_pendaftar'] . "</td>";
                    echo "<td>" . $row['email_pendaftar'] . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                    $i++;
                  }
                } else {
                  echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <footer class="bg-body-tertiary text-center text-lg-start text-light mt-5 fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #5cb874;">
      © 2024 Copyright:
      <a class="text-light" href="">GreenCulture.com</a>
    </div>
    <!-- Copyright -->
  </footer>

  <script>
    // Fungsi untuk mencegah kembali ke halaman sebelumnya setelah logout
    $(document).ready(function() {
      $('#logoutModal').on('shown.bs.modal', function() {
        $(this).data('modal', null);
      });
    });
  </script>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>