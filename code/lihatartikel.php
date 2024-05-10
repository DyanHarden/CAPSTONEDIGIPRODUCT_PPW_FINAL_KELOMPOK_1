<?php
require '../koneksi.php';

$query = 'SELECT * FROM artikel';
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/exindex.css">
    <link href="../assets/img/favicon-16x16.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
</head>

<body>

    <header>
        <nav class="navbar navbar-light bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fs-3 fw-bold fst-italic" style="color: #5cb874;">Green Culture</a>
                <form class="d-flex input-group w-auto">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <a href="../index.php" class="btn btn-success">Kembali</a>
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row">
            <div class="section-title text-center mt-5">
                <h2 class="fs-3">Artikel dari Pahlawan</h2>
                <p></p>
            </div>
            <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../assets/img/<?= $data['gambar'] ?>" class="card-img-top" alt="Edukasi Emisi Kendaraan" />
                        <div class="card-body shadow-sm">
                            <h5 class="card-title"><?= $data['judul']; ?></h5>
                            <a href="detailartikel.php?id=<?= $data['id_artikel'] ?>" class="btn btn-success">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="mt-5">
        <path fill="#5cb874" fill-opacity="1" d="M0,32L48,69.3C96,107,192,181,288,186.7C384,192,480,128,576,101.3C672,75,768,85,864,106.7C960,128,1056,160,1152,170.7C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <h3 style="color: #ffff" class="fst-italic">Green Culture</h3>
            <p>
                "Satu Langkah Kecil, Satu Perubahan Besar. Bersama Green Culture, Berani Beraksi untuk
                Bumi Hijau".
            </p>
            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright <strong><span>Green Culture</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>