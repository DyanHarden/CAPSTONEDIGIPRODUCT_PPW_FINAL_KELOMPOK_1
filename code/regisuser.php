<?php
// Include file koneksi database
include '../koneksi.php';

// Fungsi untuk melakukan hashing password
function hashPassword($password)
{
    // Lakukan hashing password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    return $hashed_password;
}

// Proses registrasi user
if (isset($_POST['register'])) {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan hashing pada password sebelum disimpan di database
    $hashed_password = hashPassword($password);

    // Tentukan role_akun
    $role_akun = 'user'; // Hanya admin atau user

    // Lakukan query untuk menyimpan data pengguna ke dalam database
    $query = "INSERT INTO akun (nama, username, email, password, role_akun) VALUES ('$nama', '$username', '$email', '$hashed_password', '$role_akun')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman login jika registrasi berhasil
        header("Location: loginuser.php");
        exit;
    } else {
        // Tampilkan pesan error jika terjadi kesalahan saat registrasi
        $error = "Gagal melakukan registrasi. Silakan coba lagi.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="../assets/img/favicon-16x16.png" rel="icon" />
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Registrasi User</title>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black mt-3 border-success" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <a href="loginuser.php" class="btn btn-success btn-sm position-absolute top-0 end-0 m-3 fst-italic">Login Sekarang</a>

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Welcome, Hero!</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <!-- Input nama -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa-solid fa-address-card fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" class="form-control" placeholder="Your Name" name="nama" />
                                            </div>
                                        </div>

                                        <!-- Input username -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example3c" class="form-control" placeholder="Username" name="username" />
                                            </div>
                                        </div>

                                        <!-- Input email -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example4c" class="form-control" placeholder="Email" name="email" />
                                            </div>
                                        </div>

                                        <!-- Input password -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4cd" class="form-control" placeholder="Password" name="password" />
                                            </div>
                                        </div>

                                        <!-- Tombol registrasi -->
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-success btn-lg" name="register">Register</button>
                                        </div>
                                    </form>
                                    <!-- Pesan kesalahan -->
                                    <?php if (isset($error)) { ?>
                                        <div class="text-danger text-center mt-3"><?php echo $error; ?></div>
                                    <?php } ?>
                                </div>

                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="../assets/img/undraw_environment_iaus.png" class="img-fluid mt-5" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>