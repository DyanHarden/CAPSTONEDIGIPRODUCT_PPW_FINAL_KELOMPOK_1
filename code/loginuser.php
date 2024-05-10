<?php
session_start();

// Include file koneksi database
include '../koneksi.php';

// Proses login user
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Lakukan query untuk mencari data user dengan username yang sesuai
  $query = "SELECT * FROM akun WHERE username='$username' AND role_akun='user'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Periksa apakah password yang dimasukkan cocok dengan hash password dalam database
    if (password_verify($password, $row['password'])) {
      // Set session untuk menyimpan informasi login user
      $_SESSION['user_id'] = $row['id_akun'];
      $_SESSION['user_username'] = $row['username'];
      $_SESSION['user_nama'] = $row['nama'];
      // Redirect ke halaman dashboard user atau halaman lain yang diinginkan
      header("Location: dbuser/dashboarduser.php");
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anggota Green Culture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <!-- Favicons -->
  <link href="../assets/img/favicon-16x16.png" rel="icon" />
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
  <link rel="stylesheet" href="../assets/css/exindex.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <a href="../index.php" class="btn btn-success btn-sm position-absolute top-0 start-0 m-3 fst-italic">Kembali Beranda</a>
          <img src="../assets/img/undraw_Explore_re_8l4v.png" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <div class="card shadow-sm border-success p-4">
            <!-- Form login user -->
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <!-- Username input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" class="form-control form-control-lg" name="username" />
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" class="form-control form-control-lg" name="password" />
              </div>

              <div class="d-flex justify-content-around align-items-center mb-4">
                <!--  -->
                <div class="form-check">
                  Tidak memiliki akun? <a href="regisuser.php">Registrasi disini!</a>
                </div>
              </div>

              <!-- Submit button -->
              <div class="d-grid">
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" name="login">Sign in</button>
              </div>

              <div class="divider d-flex align-items-center my-4">
                <hr class="flex-grow-1 mx-3" style="background-color: #5cb874;">
                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                <hr class="flex-grow-1 mx-3" style="background-color: #5cb874;">
              </div>

              <a data-mdb-ripple-init class="btn btn-success btn-lg btn-block fs-6" style="background-color: #5cb874" href="loginadmin.php" role="button">
                <i class="fa-solid fa-user-tie me-2"></i>Continue as Admin
              </a>

            </form>
            <!-- End of Form login user -->
          </div>
        </div>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>