<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Tiket Konser</title>
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
    <div class="sidebar">
        <h2><span class="material-symbols-outlined">local_activity</span>e-Tiket Konser</h2>
        <hr>
        <ul>
            <li><a href="dashboard.php"><span class="material-symbols-outlined">monitoring</span>Dashboard</a></li>
            <li><a href="buatTiket.php"><span class="material-symbols-outlined">confirmation_number</span>Buat Tiket</a></li>
            <li><a href="daftarTiket.php"><span class="material-symbols-outlined">fact_check</span>Daftar Tiket</a></li>
            <li><a href="daftarAkun.php"><span class="material-symbols-outlined">account_circle</span>Daftar Akun</a></li>
            <li><a href="tentangKami.php"><span class="material-symbols-outlined">info</span>Tentang Kami</a></li>
            <li><a href="kontak.php"><span class="material-symbols-outlined">support_agent</span>Kontak Kami</a></li>
            <li><a href="../auth/login.php"><span class="material-symbols-outlined">login</span>Logout</a></li>
        </ul>
        <p>Copyright©Kelompok8. All Rights Reserved</p>
    </div>

    <div class="dashboard-container">
        <h1 class="dashboard-tittle">Dashboard <span>Control Panel</span></h1>

        <div class="dashboard-box-user">
            <h2 class="dashboard-box-user-tittle"><span class="material-symbols-outlined">groups</span> Total Pengguna</h2>
            <h3 class="dashboard-box-total-user">0</h3>
        </div>
        <div class="dashboard-box-ticket">
            <h2 class="dashboard-box-ticket-tittle"><span class="material-symbols-outlined">confirmation_number</span> Total Tiket</h2>
            <h3 class="dashboard-box-total-ticket">0</h3>
        </div>
    </div>
</body>

</html>