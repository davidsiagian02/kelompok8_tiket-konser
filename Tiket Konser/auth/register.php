<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-Tiket Konser | Register Akun</title>
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
  <div class="reg-container">
    <div class="reg-wrapper">
      <h2 class="reg-tittle">REGISTER</h2>
      <label class="reg-text" for="reg-text"><span class="material-symbols-outlined">person</span>Username</label>
      <input class="reg-input" type="text" name="username" placeholder="Masukkan username" required>
      <label class="reg-text" for="reg-text"><span class="material-symbols-outlined">alternate_email</span>Email</label>
      <input class="reg-input" type="text" name="email" placeholder="Masukkan email" required>
      <label class="reg-text" for="reg-text"><span class="material-symbols-outlined">calendar_month</span>Tanggal Lahir</label>
      <input class="reg-input" type="date" name="date">
      <label class="reg-text" for="reg-text"><span class="material-symbols-outlined">lock</span>Password</label>
      <input class="reg-input" type="password" name="password" placeholder="Masukkan password" required>
      <label class="reg-text" for="reg-text"><span class="material-symbols-outlined">lock</span>Ulangi Password</label>
      <input class="reg-input" type="ulang_password" name="ulang_password" placeholder="Masukkan password" required>
      
      <button class="reg-button" name="submit">Register</button>
      <p class="reg-info">Sudah punya akun? <a href="login.php">login disini</a></p>
    </div>
  </div>
</body>
</html>