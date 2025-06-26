<?php
//session_start();
$active_page = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title ?? 'TiketKu'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --dark-bg: #111827;
            --sidebar-width: 260px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            font-size: 15px; 
        }
        .wrapper { display: flex; width: 100%; min-height: 100vh; }

        #sidebar {
            width: var(--sidebar-width); min-height: 100vh;
            background: var(--dark-bg); color: #fff; transition: all 0.3s;
        }
        #sidebar .sidebar-header { padding: 20px; background: rgba(255,255,255,0.05); text-align: center; }
        #sidebar .sidebar-header h3 { color: #fff; font-weight: 600; }
        #sidebar .sidebar-header h3 .fa-ticket { color: var(--primary-color); }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a {
            padding: 14px 20px; font-size: 1em; display: block;
            color: #adb5bd; transition: all 0.2s ease-in-out;
            border-left: 4px solid transparent;
            text-decoration: none;
        }
        #sidebar ul li a:hover {
            color: #fff; background: var(--primary-color);
            border-left-color: #a5b4fc;
        }
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: #fff; background: var(--primary-color);
            border-left-color: #a5b4fc;
        }
        #sidebar ul li a i { margin-right: 12px; width: 20px; text-align: center; }
        .offcanvas a, .offcanvas a:hover { text-decoration: none; }
        
        /* === KONTEN UTAMA === */
        #content {
            width: calc(100% - var(--sidebar-width)); padding: 25px 40px;
            min-height: 100vh; transition: all 0.3s;
        }
        .page-title { font-weight: 700; color: #343a40; }
        .card {
            border: none; border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #fff; border-bottom: 1px solid #f1f1f1;
            border-radius: 12px 12px 0 0 !important; font-weight: 600;
            padding: 1rem 1.5rem;
        }
        
        /* === PERBAIKAN CARD STATISTIK (GAMBAR 1) === */
        .stat-card-body {
            display: flex;
            align-items: center;
        }
        .stat-card-icon {
            flex-shrink: 0;
            display: grid;
            place-items: center;
            width: 50px; height: 50px;
        }
        .stat-card-content {
            flex-grow: 1;
            min-width: 0;
        }
        .stat-card-title {
            color: #6c757d;
            font-size: 0.9em;
            margin-bottom: 0;
        }
        .stat-card-number {
            font-weight: 700;
            color: var(--dark-bg);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1.5rem;
        }

        /* === PERBAIKAN TOMBOL AKSI (GAMBAR 2) === */
        .action-buttons {
            display: inline-flex;
            gap: 0.5rem;
        }
        .table td[data-label="Aksi"] {
           text-align: right;
        }

        /* LAPTOP KECIL & LAYAR DENGAN RESOLUSI LEBIH RENDAH (1200px kebawah) */
        @media (max-width: 1200px) {
            #content { padding: 25px; }
            .page-title { font-size: 1.8rem; }
            .stat-card-number { font-size: 1.3rem; }
            .stat-card-icon { width: 45px; height: 45px; }
            .stat-card-icon .fa-2x { font-size: 1.5em; }
        }

        /* TABLET (992px kebawah) */
        @media (max-width: 991.98px) {
            #sidebar { margin-left: -var(--sidebar-width); }
            #content { width: 100%; }
            .navbar-mobile { display: flex !important; }
            .stat-card-number { font-size: 1.4rem; }
        }
        
        /* MOBILE (768px kebawah) */
        @media (max-width: 767.98px) {
            body { font-size: 14px; }
            #sidebar { display: none; }
            #content { padding: 15px; }
            .page-title { font-size: 1.5rem; }
            .table thead { display: none; }
            .table tr {
                display: block; margin-bottom: 1rem;
                border-radius: 12px; border: 1px solid #e9ecef;
                box-shadow: none;
            }
            .table td {
                display: flex; justify-content: space-between;
                align-items: center; padding: 0.8rem 1rem;
                text-align: right; border: none;
                border-bottom: 1px solid #e9ecef;
            }
            .table tr td:last-child { border-bottom: none; }
            .table td::before {
                content: attr(data-label); font-weight: 600;
                text-align: left; padding-right: 1rem; color: #555;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="d-none d-lg-block">
        <div class="sidebar-header">
            <h3><i class="fa-solid fa-ticket"></i> TiketKu</h3>
        </div>
        <ul class="list-unstyled components">
            <li class="<?php echo ($active_page == '../Admin/Dashboard.php') ? 'active' : ''; ?>">
                <a href="../Admin/Dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="<?php echo ($active_page == '../Admin/LaporanPenjualan.php') ? 'active' : ''; ?>">
                <a href="../Admin/LaporanPenjualan.php"><i class="fas fa-file-invoice-dollar"></i> Laporan Penjualan</a>
            </li>
             <li class="<?php echo ($active_page == '../Admin/TambahKonser.php') ? 'active' : ''; ?>">
                <a href="../Admin/TambahKonser.php"><i class="fas fa-plus-circle"></i> Tambah Konser</a>
            </li>
        </ul>
        <div class="mt-auto">
            <ul class="list-unstyled sidebar-footer">
                <li>
                    <a href="../Auth/Logout.php" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div id="content">
        <!-- Navbar untuk Mobile & Tablet -->
        <nav class="navbar navbar-mobile d-lg-none justify-content-between align-items-center mb-4 bg-dark text-white rounded-3 p-2">
             <h3 class="m-0 fs-5"><i class="fa-solid fa-ticket text-primary"></i> TiketKu</h3>
             <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
        
        <!-- Offcanvas Mobile Menu -->
        <div class="offcanvas offcanvas-start bg-dark text-light" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title" id="mobileMenuLabel">Menu Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <ul class="list-unstyled flex-grow-1">
                    <li class="mb-2"><a class="d-block p-2 rounded <?php echo ($active_page == '../Admin/Dashboard.php') ? 'active' : ''; ?>" href="../Admin/Dashboard.php"><i class="fas fa-home fa-fw me-2"></i> Dashboard</a></li>
                    <li class="mb-2"><a class="d-block p-2 rounded <?php echo ($active_page == '../Admin/LaporanPenjualan.php') ? 'active' : ''; ?>" href="../Admin/LaporanPenjualan.php"><i class="fas fa-file-invoice-dollar fa-fw me-2"></i> Laporan Penjualan</a></li>
                    <li class="mb-2"><a class="d-block p-2 rounded <?php echo ($active_page == '../Admin/TambahKonser.php') ? 'active' : ''; ?>" href="../Admin/TambahKonser.php"><i class="fas fa-plus-circle fa-fw me-2"></i> Tambah Konser</a></li>
                </ul>
                <div>
                     <a class="d-block p-2 rounded text-danger bg-danger bg-opacity-10" href="../Auth/Logout.php"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (isset($_SESSION['pesan'])): ?>
            <div class="alert alert-<?php echo $_SESSION['pesan']['tipe']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['pesan']['isi']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['pesan']); ?>
        <?php endif; ?>
