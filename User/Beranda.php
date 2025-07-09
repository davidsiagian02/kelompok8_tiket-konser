<?php
session_start();
// Untuk memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Auth/Login.php");
    exit;
}

require_once '../Config/Database.php';
echo <<<HTML
<style>
.concert-card-v2 {
    background-color: #fff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}
.concert-card-v2:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}
.card-img-container {
    position: relative;
    height: 200px;
}
.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.price-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(5px);
}
.card-details {
    padding-top: 1rem;
    border-top: 1px solid #eee;
}
</style>
HTML;

include '../Layout/User/HeaderUser.php';

// Fungsi pencarian dan filter
$search_term = '';
$sort_order = 'tanggal_asc';
$where_clauses = ["stok_tiket > 0"];
$order_by_clause = 'ORDER BY tanggal ASC';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where_clauses[] = "(nama_konser LIKE '%$search_term%' OR artis LIKE '%$search_term%')";
}

if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $sort_order = $_GET['sort'];
    switch ($sort_order) {
        case 'harga_tertinggi': $order_by_clause = 'ORDER BY harga_tiket DESC'; break;
        case 'harga_terendah': $order_by_clause = 'ORDER BY harga_tiket ASC'; break;
        default: $order_by_clause = 'ORDER BY tanggal ASC'; $sort_order = 'tanggal_asc'; break;
    }
}

$query = "SELECT * FROM daftarkonser";
if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(' AND ', $where_clauses);
}
$query .= " " . $order_by_clause;
$hasil = mysqli_query($koneksi, $query);
?>

<div class="container my-5">
    <!-- Hero Section dan Form Filter -->
    <div class="p-5 text-center bg-body-tertiary rounded-3 mb-5" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1974&auto=format&fit=crop'); background-size: cover; background-position: center;">
        <h1 class="text-white display-4 fw-bold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p class="col-lg-8 mx-auto fs-5 text-white-50">Temukan dan beli tiket untuk konser musik paling seru tahun ini. Jangan sampai kehabisan!</p>
    </div>
    <div class="card mb-5 shadow-sm">
        <div class="card-body p-4">
            <form action="Beranda.php" method="GET" class="row g-3 align-items-end">
                <div class="col-lg-6 col-md-12"><label for="search" class="form-label">Cari Konser atau Artis</label><input type="text" class="form-control" id="search" name="search" placeholder="Contoh: Hindia, Festival..." value="<?php echo htmlspecialchars($search_term); ?>"></div>
                <div class="col-lg-4 col-md-6"><label for="sort" class="form-label">Urutkan Berdasarkan</label><select id="sort" name="sort" class="form-select"><option value="tanggal_asc" <?php if ($sort_order == 'tanggal_asc') echo 'selected'; ?>>Tanggal Terdekat</option><option value="harga_terendah" <?php if ($sort_order == 'harga_terendah') echo 'selected'; ?>>Harga Terendah</option><option value="harga_tertinggi" <?php if ($sort_order == 'harga_tertinggi') echo 'selected'; ?>>Harga Tertinggi</option></select></div>
                <div class="col-lg-2 col-md-6"><div class="d-grid"><button type="submit" class="btn btn-dark"><i class="fa-solid fa-filter me-1"></i> Terapkan</button></div></div>
            </form>
        </div>
    </div>
    
    <h2 class="mb-4 text-center fw-bold">Konser yang Tersedia</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
        <?php if ($hasil && mysqli_num_rows($hasil) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                <?php
                    $placeholder = 'https://placehold.co/600x400/212529/FFFFFF?text=' . urlencode($row['artis']);
                    $imageUrl = !empty($row['gambar_url']) ? htmlspecialchars($row['gambar_url']) : $placeholder;
                ?>
                <div class="col d-flex">
                    <div class="card concert-card-v2 w-100">
                        <div class="card-img-container">
                            <img src="<?php echo $imageUrl; ?>" class="card-img-top" alt="Poster Konser" onerror="this.onerror=null; this.src='<?php echo $placeholder; ?>';">
                            <div class="price-badge">Rp <?php echo number_format($row['harga_tiket'], 0, ',', '.'); ?></div>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <div class="flex-grow-1">
                                <h5 class="card-title fw-bold mb-1"><?php echo htmlspecialchars($row['nama_konser']); ?></h5>
                                <p class="text-muted small"><i class="fa-solid fa-microphone fa-fw me-1"></i><?php echo htmlspecialchars($row['artis']); ?></p>
                            </div>
                            <div class="card-details">
                                <p class="mb-2 small d-flex align-items-center"><i class="fa-solid fa-calendar-days fa-fw me-2"></i><?php echo date('d F Y', strtotime($row['tanggal'])); ?></p>
                                <p class="mb-0 small d-flex align-items-center"><i class="fa-solid fa-location-dot fa-fw me-2"></i><?php echo htmlspecialchars($row['lokasi']); ?></p>
                            </div>
                            <div class="d-grid mt-3">
                                <a href="PesanTiket.php?id=<?php echo $row['id_konser']; ?>" class="btn btn-primary fw-bold">Beli Tiket</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- Tampilan Jika Belum Ada Konser Yang Di Input-->
            <div class="col-12">
                <div class="text-center py-5 px-4 bg-light rounded-3">
                    <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-616.jpg" alt="[Gambar ilustrasi tiket kosong]" class="img-fluid mb-4" style="max-width: 250px;">
                    <h3 class="fw-bold">Yah, Belum Ada Konser Baru!</h3>
                    <p class="text-muted col-lg-6 mx-auto">Saat ini semua tiket mungkin sudah habis atau belum ada jadwal konser baru yang ditambahkan.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../Layout/User/FooterUser.php'; ?>
