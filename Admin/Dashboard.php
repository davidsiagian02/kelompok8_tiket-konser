<?php
session_start();
// Lindungi halaman ini, hanya untuk admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
require_once '../Config/Database.php';
$page_title = 'Dashboard Admin';
include '../Layout/Admin/HeaderAdmin.php';

// Semua Operasi Agregat

// Count untuk menampilkan total konser
$result_total_konser = mysqli_query($koneksi, "SELECT COUNT(id_konser) AS total FROM konser");
$total_konser = mysqli_fetch_assoc($result_total_konser)['total'];

// Sum untuk menampilkan total tiket terjual dan total pendapatan
$result_total_terjual = mysqli_query($koneksi, "SELECT SUM(jumlah_tiket) AS total FROM transaksi");
$total_terjual = mysqli_fetch_assoc($result_total_terjual)['total'] ?? 0;
$result_total_pendapatan = mysqli_query($koneksi, "SELECT SUM(total_harga) AS total FROM transaksi");
$total_pendapatan = mysqli_fetch_assoc($result_total_pendapatan)['total'] ?? 0;

// Max untuk menampilkan harga tiket termahal
$result_max_harga = mysqli_query($koneksi, "SELECT MAX(harga_tiket) AS maks FROM konser");
$max_harga = mysqli_fetch_assoc($result_max_harga)['maks'] ?? 0;

// Min untuk menampilkan harga tiket termurah
$result_min_harga = mysqli_query($koneksi, "SELECT MIN(harga_tiket) AS termurah FROM konser");
$data_min_harga = mysqli_fetch_assoc($result_min_harga);
$min_harga = $data_min_harga['termurah'] ?? 0;

// Avg untuk menampilkan harga rata rata tiket
$result_avg_harga = mysqli_query($koneksi, "SELECT AVG(harga_tiket) AS rata_rata FROM konser");
$data_avg_harga = mysqli_fetch_assoc($result_avg_harga);
$avg_harga = $data_avg_harga['rata_rata'] ?? 0;

// Fungsi Pencarian dan Filter
$search_term = '';
$sort_order = 'tanggal_desc';
$where_clauses = [];
$order_by_clause = 'ORDER BY tanggal DESC';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where_clauses[] = "(nama_konser LIKE '%$search_term%' OR artis LIKE '%$search_term%')";
}

if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $sort_order = $_GET['sort'];
    switch ($sort_order) {
        case 'harga_tertinggi': $order_by_clause = 'ORDER BY harga_tiket DESC'; break;
        case 'harga_terendah': $order_by_clause = 'ORDER BY harga_tiket ASC'; break;
        case 'stok_terbanyak': $order_by_clause = 'ORDER BY stok_tiket DESC'; break;
        default: $order_by_clause = 'ORDER BY tanggal DESC'; $sort_order = 'tanggal_desc'; break;
    }
}

$query = "SELECT * FROM daftarkonser";
if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(' AND ', $where_clauses);
}
$query .= " " . $order_by_clause;
$hasil = mysqli_query($koneksi, $query);
?>

<h2 class="page-title mb-4">Dashboard Admin</h2>

<!-- Card Statistik -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-primary bg-opacity-10 rounded-3 me-3">
                    <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Total Konser</p>
                    <div class="stat-card-number"><?php echo $total_konser; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-success bg-opacity-10 rounded-3 me-3">
                    <i class="fas fa-ticket fa-2x text-success"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Tiket Terjual</p>
                    <div class="stat-card-number"><?php echo number_format($total_terjual); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-info bg-opacity-10 rounded-3 me-3">
                    <i class="fas fa-dollar-sign fa-2x text-info"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Total Pendapatan</p>
                    <div class="stat-card-number">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-warning bg-opacity-10 rounded-3 me-3">
                    <i class="fas fa-arrow-up fa-2x text-warning"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Tiket Termahal</p>
                    <div class="stat-card-number">Rp <?php echo number_format($max_harga, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-success bg-opacity-10 rounded-3 me-3">
                    <i class="fas fa-arrow-down fa-2x text-success"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Tiket Termurah</p>
                    <div class="stat-card-number">Rp <?php echo number_format($min_harga, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body stat-card-body">
                <div class="stat-card-icon bg-purple bg-opacity-10 rounded-3 me-3" style="--bs-purple: #6f42c1;">
                    <i class="fas fa-chart-line fa-2x text-purple" style="color: var(--bs-purple);"></i>
                </div>
                <div class="stat-card-content">
                    <p class="stat-card-title">Rata-rata Harga</p>
                    <div class="stat-card-number">Rp <?php echo number_format($avg_harga, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Pencarian & Filter -->
<div class="card">
    <div class="card-header">
        <h5><i class="fa-solid fa-search me-2"></i> Kelola Konser</h5>
    </div>
    <div class="card-body">
        <form action="Dashboard.php" method="GET" class="row g-3 align-items-end">
            <div class="col-lg-5 col-md-12">
                <label for="search" class="form-label">Cari Nama Konser / Artis</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Ketik di sini..." value="<?php echo htmlspecialchars($search_term); ?>">
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="sort" class="form-label">Urutkan Berdasarkan</label>
                <select id="sort" name="sort" class="form-select">
                    <option value="tanggal_desc" <?php if ($sort_order == 'tanggal_desc') echo 'selected'; ?>>Tanggal Terbaru</option>
                    <option value="harga_tertinggi" <?php if ($sort_order == 'harga_tertinggi') echo 'selected'; ?>>Harga Tertinggi</option>
                    <option value="harga_terendah" <?php if ($sort_order == 'harga_terendah') echo 'selected'; ?>>Harga Terendah</option>
                    <option value="stok_terbanyak" <?php if ($sort_order == 'stok_terbanyak') echo 'selected'; ?>>Stok Terbanyak</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter me-1"></i> Terapkan</button>
                    <a href="Dashboard.php" class="btn btn-secondary"><i class="fa-solid fa-rotate-left me-1"></i> Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Daftar Konser -->
<div class="card">
    <div class="card-header">
        <h5><i class="fa-solid fa-list me-2"></i> Daftar Konser</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama Konser</th>
                        <th scope="col">Artis</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Harga Tiket</th>
                        <th scope="col">Stok</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($hasil) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                            <tr>
                                <td data-label="Konser"><?php echo htmlspecialchars($row['nama_konser']); ?><br><small class="text-muted"><?php echo htmlspecialchars($row['lokasi']); ?></small></td>
                                <td data-label="Artis"><?php echo htmlspecialchars($row['artis']); ?></td>
                                <td data-label="Tanggal"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                                <td data-label="Harga">Rp <?php echo number_format($row['harga_tiket'], 0, ',', '.'); ?></td>
                                <td data-label="Stok"><?php echo number_format($row['stok_tiket']); ?></td>
                                <td data-label="Aksi" class="text-end">
                                    <div class="action-buttons">
                                        <a href="EditKonser.php?id=<?php echo $row['id_konser']; ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="javascript:void(0);" onclick="konfirmasiHapus('HapusKonser.php?id=<?php echo $row['id_konser']; ?>')" class="btn btn-sm btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-4">Tidak ada konser yang cocok dengan kriteria Anda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../Layout/Admin/FooterAdmin.php';
?>
