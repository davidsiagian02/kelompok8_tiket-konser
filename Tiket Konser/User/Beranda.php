<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Auth/Login.php");
    exit;
}

require_once '../Config/Database.php';
include '../Layout/User/HeaderUser.php'; 

$query = "SELECT * FROM konser WHERE stok_tiket > 0 ORDER BY tanggal ASC";
$hasil = mysqli_query($koneksi, $query);

?>

<div class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3 mb-5" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1974&auto=format&fit=crop'); background-size: cover; background-position: center;">
        <h1 class="text-white display-4 fw-bold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p class="col-lg-8 mx-auto fs-5 text-white-50">
          Temukan dan beli tiket untuk konser musik paling seru tahun ini. Jangan sampai kehabisan!
        </p>
      </div>

    <h2 class="mb-4 text-center fw-bold">Konser yang Akan Datang</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
        <?php if (mysqli_num_rows($hasil) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                <?php
                    // Logika untuk menentukan URL gambar (Jika URL gambar kosong, gunakan placeholder)
                    $placeholder = 'https://placehold.co/600x400/212529/FFFFFF?text=' . urlencode($row['artis']);
                    $imageUrl = !empty($row['gambar_url']) ? htmlspecialchars($row['gambar_url']) : $placeholder;
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm concert-card">
                        <img src="<?php echo $imageUrl; ?>" 
                             class="card-img-top" 
                             alt="Poster Konser <?php echo htmlspecialchars($row['nama_konser']); ?>" 
                             style="height: 200px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='<?php echo $placeholder; ?>';">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['nama_konser']); ?></h5>
                            <p class="card-text text-muted"><i class="fa-solid fa-microphone me-2"></i><?php echo htmlspecialchars($row['artis']); ?></p>
                            <div class="mt-auto">
                                <p class="mb-2"><i class="fa-solid fa-calendar-days me-2"></i><?php echo date('d F Y', strtotime($row['tanggal'])); ?></p>
                                <p class="mb-2"><i class="fa-solid fa-location-dot me-2"></i><?php echo htmlspecialchars($row['lokasi']); ?></p>
                                <h4 class="fw-light mt-3">Rp <?php echo number_format($row['harga_tiket'], 0, ',', '.'); ?></h4>
                                <div class="d-grid">
                                    <a href="PesanTiket.php?id=<?php echo $row['id_konser']; ?>" class="btn btn-primary fw-bold">Beli Tiket</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5 px-4 bg-light rounded-3">
                    <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-616.jpg" alt="[Gambar ilustrasi tiket kosong]" class="img-fluid mb-4" style="max-width: 250px;">
                    <h3 class="fw-bold">Yah, Belum Ada Konser Baru!</h3>
                    <p class="text-muted col-lg-6 mx-auto">
                        Saat ini semua tiket mungkin sudah habis atau belum ada jadwal konser baru yang ditambahkan. Silakan cek kembali nanti, ya!
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../Layout/User/FooterUser.php'; ?>
