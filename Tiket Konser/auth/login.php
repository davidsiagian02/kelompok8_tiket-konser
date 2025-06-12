<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket Konser | Login Akun</title>
  <!-- Import Style -->
  <link rel="stylesheet" href="../css/colors.css">
  <link rel="stylesheet" href="../css/layout.css">
  <link rel="stylesheet" href="../css/components.css">

  <!-- Import Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- Icons Website -->
  <link rel="icon" type="image" href="../assets/logo_ticket.png">
</head>
<body>
  <div class="login-container">
    <div class="login-wrapper">
      <h2 class="login-tittle">LOGIN</h2>
      <label class="login-text" for="login-text"><span class="material-symbols-outlined">person</span>Username</label>
      <input class="login-input" type="text" name="text" id="text" placeholder="Masukkan username" required>
      <label class="login-text" for="login-text"><span class="material-symbols-outlined">lock</span>Password</label>
      <input class="login-input" type="password" name="password" id="password" placeholder="Masukkan password" required>
      
      <button class="login-button" name="submit">Login</button>
      <p class="login-info">Belum punya akun? <a href="register.php">daftar disini</a></p>
    </div>
  </div>
</body>
</html>