<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Konser | Buat Tiket</title>
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

    <div class="createTicket-container">
        <h1 class="createTicket-tittle">Buat Tiket <span>New Ticket</span></h1>

        <div class="createTicket-wrapper">
            <label class="createTicket-text" for="login-text">Judul:</label>
            <input class="createTicket-input" type="text" name="text" placeholder="Masukkan judul" required>
            <label class="createTicket-text" for="login-text">Deskripsi:</label>
            <textarea class="createTicket-input" name="createTicket-description" cols="2" rows="10" placeholder="Jelaskan deskripsi tiket...." required></textarea>
            <label class="createTicket-text" for="login-text">Harga:</label>
            <input class="createTicket-input" type="number" name="text" placeholder="Rp. 150.000,00" required>
            <label class="createTicket-text" for="login-text">Jumlah Tiket:</label>
            <input class="createTicket-input" type="number" name="text" placeholder="200" required>
            <label class="createTicket-text" for="login-text">Batas Umur:</label>
            <select class="createTicket-input" name="" required>
                <option value="">6-12 Tahun</option>
                <option value="">13-17 Tahun</option>
                <option value="">18-25 Tahun</option>
                <option value="">26+ Tahun</option>
            </select>
            <label class="createTicket-text" for="login-text">Durasi:</label>
            <input class="createTicket-input" type="number" name="text" required>
            <label class="createTicket-text" for="login-text">Lokasi:</label>
            <input class="createTicket-input" type="text" name="text" placeholder="Masukkan nama lokasi" required>
            <label class="createTicket-text" for="login-text">Jenis Tiket:</label>
            <select class="createTicket-input" name="" required>
                <option value="">Reguler</option>
                <option value="">VIP</option>
            </select>
            <label class="createTicket-text" for="login-text">No. Gate:</label>
            <select class="createTicket-input" name="" required>
                <option value="">Gate 1A</option>
                <option value="">Gate 1B</option>
                <option value="">Gate 1C</option>
                <option value="">Gate 1D</option>
                <option value="">Gate 2A</option>
                <option value="">Gate 2B</option>
                <option value="">Gate 2C</option>
                <option value="">Gate 2D</option>
                <option value="">Gate 3A</option>
                <option value="">Gate 3B</option>
                <option value="">Gate 3C</option>
                <option value="">Gate 3D</option>
            </select>

            <button class="createTicket-button" name="submit">Buat Tiket<span class="material-symbols-outlined">arrow_forward_ios</span></button>
        </div>
    </div>
</body>

</html>