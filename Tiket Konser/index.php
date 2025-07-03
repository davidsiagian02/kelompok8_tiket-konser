<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TiketKu - Beli Tiket Konser Mudah & Cepat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Font 1 -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> -->

    <!-- Font 2 -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Open Sans', sans-serif; }
        .hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 8rem 0;
        }
        .hero h1 { font-weight: 800; }
        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            font-size: 2rem;
        }
        .section-title { font-weight: 700; margin-bottom: 2rem; }
        .footer { background-color: #111827; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-ticket me-2"></i>TiketKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="btn btn-outline-light me-2" href="Auth/Login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="Auth/Register.php">Daftar Sekarang</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero text-center">
        <div class="container">
            <h1 class="display-3">Temukan Pengalaman Konser Terbaik Anda</h1>
            <p class="lead col-lg-8 mx-auto">Beli tiket konser dari artis favorit Anda dengan mudah, cepat, dan aman. Jangan lewatkan momen tak terlupakan!</p>
            <a href="Auth/Register.php" class="btn btn-primary btn-lg mt-3">Mulai Sekarang <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Kenapa Memilih TiketKu?</h2>
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-circle mb-3">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h4 class="fw-bold">Proses Cepat</h4>
                    <p class="text-muted">Pesan tiket hanya dalam beberapa klik. Tidak perlu antri, tidak perlu ribet.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle mb-3">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="fw-bold">Transaksi Aman</h4>
                    <p class="text-muted">Sistem pembayaran terverifikasi menjamin keamanan setiap transaksi Anda.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon bg-warning bg-opacity-10 text-warning rounded-circle mb-3">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h4 class="fw-bold">Harga Terbaik</h4>
                    <p class="text-muted">Dapatkan penawaran harga tiket konser yang kompetitif dan transparan.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Call to Action Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="section-title">Siap untuk Berpetualang?</h2>
            <p class="lead col-lg-6 mx-auto text-muted">Buat akun Anda sekarang dan jadilah bagian dari ribuan penikmat musik lainnya.</p>
            <a href="Auth/Login.php" class="btn btn-dark btn-lg mt-3">Login atau Daftar</a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> TiketKu. All Right Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
