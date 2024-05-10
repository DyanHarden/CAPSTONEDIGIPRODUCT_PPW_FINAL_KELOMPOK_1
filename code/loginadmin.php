<?php
session_start();

// Include file koneksi database
include '../koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan query untuk mencari data admin dengan username yang sesuai
    $query = "SELECT * FROM akun WHERE username='$username' AND role_akun='admin'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Periksa apakah password yang dimasukkan cocok dengan password dalam database
        if (password_verify($password, $row['password'])) {
            // Set session untuk menyimpan informasi login admin
            $_SESSION['admin_id'] = $row['id_akun'];
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['admin_nama'] = $row['nama'];
            // Redirect ke halaman dashboard admin
            header("Location: dbadmin/dashboardadmin.php");
            exit;
        } else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Username atau password salah";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/exindex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Favicons -->
    <link href="../assets/img/favicon-16x16.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Login Admin</title>

    <style>
        .section-before-footer {
            margin-bottom: 80px;
        }
    </style>
</head>

<body>
    <section class="d-flex flex-column min-vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <a href="../index.php" class="btn btn-success btn-sm position-absolute top-0 start-0 m-3 fst-italic">Kembali Beranda</a>
                    <img src="../assets/img/undraw_art_museum_8or4.png" class="img-fluid mt-5" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="card mt-5">
                        <div class="card-body">
                            <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4 fst-italic">Green Culture Admin</p>

                            <form method="POST">
                                <!-- username input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="form3Example3" class="form-control form-control-lg border-success fs-6" placeholder="Username" name="username" />
                                </div>
                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-3">
                                    <input type="password" id="form3Example4" class="form-control form-control-lg border-success fs-6" placeholder="Enter Password" name="password" />
                                </div>
                                <!-- Tombol login -->
                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="login">Login</button>
                                </div>
                            </form>
                            <!-- Pesan kesalahan -->
                            <?php if (isset($error)) { ?>
                                <div class="text-danger text-center mt-3"><?php echo $error; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-auto">
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-success fixed-bottom">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © Green Culture 2024. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </footer>
</body>

</html>