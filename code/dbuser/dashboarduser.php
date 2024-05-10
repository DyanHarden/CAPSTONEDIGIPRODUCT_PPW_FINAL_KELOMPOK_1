<?php
session_start();
include '../../koneksi.php';

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

if (!isset($_SESSION['user_id'])) {
  header("Location: ../loginuser.php");
  exit;
}

if (isset($_POST['buatartikel'])) {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $gambar = image_handler();
  $status = "Menunggu";
  $id_user = $_POST['id_user'];

  // Proses unggah berkas pendukung disini

  // Simpan informasi artikel ke dalam tabel artikel
  $query = "INSERT INTO artikel (judul, isi, gambar, status, id_akun) 
              VALUES ('$judul', '$isi', '$gambar', '$status', '$id_user')";
  if ($conn->query($query) === TRUE) {
    echo '<script>alert("Artikel berhasil ditambahkan!");</script>';
  } else {
    echo '<script>alert("Penambahan artikel gagal. Silakan coba lagi.");</script>';
  }
}

// PROSES DAFTAR EVENT
if (isset($_POST['daftarevent'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  // Proses unggah berkas pendukung disini
  $status = "Menunggu";
  $id_event = $_POST['event'];
  $deskripsi = $_POST['deskripsi'];
  $id_akun = $_POST['id_akun'];

  // Lakukan validasi data yang diterima dari formulir pendaftaran

  // Simpan informasi pendaftaran ke dalam tabel daftar_event
  $query = "INSERT INTO daftar_event (id_pendaftaran ,nama_pendaftar, email_pendaftar, status, id_event, id_akun) 
              VALUES ('','$nama', '$email', '$status', '$id_event', '$id_akun')";
  if ($conn->query($query) === TRUE) {
    echo '<script>alert("Pendaftaran event berhasil!");</script>';
  }
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
    echo "<script>alert('Event berhasil dihapus');</script>";
  } else {
    echo "<script>alert('Gagal menghapus event');</script>";
  }
}

$query = "SELECT * FROM artikel";
$result = $conn->query($query);

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Dashboard User</title>

  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="../../assets/img/favicon-16x16.png" rel="icon" />
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />


  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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

  <!-- Header -->
  <header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fst-italic" href="#" style="background-color: #5cb874;">Green Culture</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
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
          <a href="../logoutuser.php" class="btn btn-danger">Logout</a>
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
                Mendaftar Kegiatan Relawan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#pendaftar" style="color: #5cb874;">
                <span data-feather="home"></span>
                Tabel Pendaftar
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#membuatartikel" style="color: #5cb874;">
                <span data-feather="home"></span>
                Membuat Artikel
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End -->

      <!-- Main Section -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 fst-italic">Hello, Heroes!</h1>
          <a class="nav-link px-3 border" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a>
        </div>

        <!-- Daftar Event -->
        <section>
          <div class="p-5 mb-4 bg-light rounded-3 border border-success">
            <div class="container-fluid py-5">
              <h1 class="display-5 fw-bold fst-italic mb-4">Event Relawan Green Culture</h1>
              <p class="col-md-8 fs-5">Bergabunglah bersama-sama dalam kegiatan rutin para pahlawan, untuk menjaga lingkungan sekitar dan turut serta dalam upaya pengurangan emisi CO2. Dengan bergabung sebagai relawan, Anda dapat berperan aktif dalam membangun masa depan yang lebih hijau dan berkelanjutan.</p>
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerEventModal" style="background-color: #5cb874;">
                Daftar Sekarang
              </button>
            </div>
          </div>
        </section>

        <!-- Modal -->
        <?php
        $result = $conn->query("SELECT * FROM event");
        ?>
        <div class="modal fade" id="registerEventModal" tabindex="-1" aria-labelledby="registerEventModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="registerEventModalLabel">Pendaftaran Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Event</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" readonly></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="tempat" class="form-label">Tempat Event</label>
                    <input type="text" class="form-control" id="tempat" name="tempat" readonly>
                  </div>
                  <select class="form-select" aria-label="Default select example" name="event" onchange="setDeskripsiTempat(this)">
                    <?php while ($data = mysqli_fetch_assoc($result)) :  ?>
                      <option value="<?= $data['id_event'] ?>" data-deskripsi="<?= $data['deskripsi'] ?>" data-tempat="<?= $data['tempat'] ?>">
                        <?= $data['judul'] . " / " . $data['tanggal'] ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                  <input type="hidden" name="id_akun" value="<?= $_SESSION['user_id'] ?>">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="daftarevent" class="btn btn-primary">Daftar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal Pendaftaran Event -->
        <div class="modal fade" id="daftarEventModal" tabindex="-1" aria-labelledby="daftarEventModalLabel" aria-hidden="true">
          <!-- Isi modal di sini -->
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Isi Formulir Pendaftaran di sini -->
            </div>
          </div>
        </div>

        <!-- Artikel -->
        <div id="membuatartikel" class="mb-4 mt-5">
          <h2 class="text-center">Tambah Artikel</h2>
          <div class="card shadow-sm border-success">
            <div class="card-body">
              <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="judul" class="form-label">Judul Artikel</label>
                  <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="mb-3">
                  <label for="body" class="form-label">Body</label>
                  <input id="body" type="hidden" name="isi">
                  <trix-editor input="body"></trix-editor>
                  <div id="error-msg" style="color: red; display: none;">Body tidak boleh kosong!</div>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                <input type="hidden" name="id_user" value="<?= $_SESSION['user_id'] ?>">
                <button type="submit" name="buatartikel" class="btn btn-primary">Buat Artikel</button>
              </form>
            </div>
          </div>
        </div>


        <!-- Tabel Pendaftar -->
        <section>
          <div class="container" id="pendaftar">
            <h2 class="mt-5 mb-4 text-center">Data Daftar Event</h2>
            <form method="GET" action="">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-suceess" placeholder="Cari Nama Pendaftar" name="keyword">
                <button class="btn btn-outline-success" type="submit">Cari</button>
                <a href="dashboarduser.php" class="btn btn-outline-primary">Refresh</a>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Nama Pendaftar</th>
                    <th>Nama Event</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  if (isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    $query = "SELECT daftar_event.id_pendaftaran, daftar_event.nama_pendaftar, daftar_event.email_pendaftar, event.judul, daftar_event.status FROM daftar_event JOIN event ON daftar_event.id_event = event.id_event WHERE daftar_event.nama_pendaftar LIKE '%$keyword%'";
                  } else {
                    $query = "SELECT daftar_event.id_pendaftaran, daftar_event.nama_pendaftar, daftar_event.email_pendaftar, event.judul, daftar_event.status FROM daftar_event JOIN event ON daftar_event.id_event = event.id_event";
                  }
                  $result = $conn->query($query);
                  $i = 1;

                  // Jika data ditemukan, tampilkan ke dalam tabel
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $i . "</td>";
                      echo "<td>" . $row['nama_pendaftar'] . "</td>";
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
        </section>
      </main>
      <!-- End Main -->
    </div>
  </div>

  <footer class="bg-body-tertiary text-center text-lg-start text-light mt-3">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #5cb874;">
      © 2024 Copyright:
      <a class="text-light" href="">GreenCulture.com</a>
    </div>
    <!-- Copyright -->
  </footer>

  <script>
    function setDeskripsiTempat(selectElement) {
      var deskripsi = selectElement.options[selectElement.selectedIndex].getAttribute('data-deskripsi');
      var tempat = selectElement.options[selectElement.selectedIndex].getAttribute('data-tempat');
      document.getElementById('deskripsi').value = deskripsi;
      document.getElementById('tempat').value = tempat;
    }
  </script>
  </script>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

</html>