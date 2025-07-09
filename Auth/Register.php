<?php
session_start();
require_once '../Config/Database.php';

// Jika pengguna sudah login, jangan tampilkan halaman ini
if (isset($_SESSION['user_id'])) {
    header("Location: ../User/Beranda.php");
    exit;
}

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

    // Validasi
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = "Semua field wajib diisi.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Konfirmasi password tidak cocok.";
    } else {
        // Cek apakah username sudah ada
        $check_query = "SELECT id_user FROM users WHERE username = '$username'";
        $check_result = mysqli_query($koneksi, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Username sudah digunakan, silakan pilih yang lain.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan pengguna baru ke database
            $insert_query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";
            if (mysqli_query($koneksi, $insert_query)) {
                $success_message = "Registrasi berhasil! Silakan <a href='../index.php'>login</a>.";
            } else {
                $error_message = "Registrasi gagal, silakan coba lagi.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - TiketKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .register-card { width: 100%; max-width: 450px; border: none; border-radius: 1rem; box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .register-card .card-header { background-color: #198754; color: white; border-top-left-radius: 1rem; border-top-right-radius: 1rem; text-align: center; padding: 1.5rem 1rem; border-bottom: 0; }
        .register-card .card-header h3 { margin: 0; font-weight: 600; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card register-card">
            <div class="card-header">
                <h3><i class="fa-solid fa-user-plus me-2"></i> Buat Akun Baru</h3>
            </div>
            <div class="card-body p-4 p-md-5">
                
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php else: ?>
                    <form action="Register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Daftar</button>
                        </div>
                    </form>
                <?php endif; ?>
                <div class="text-center mt-4">
                    <small class="text-muted">Sudah punya akun? <a href="../index.php">Login di sini</a></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

