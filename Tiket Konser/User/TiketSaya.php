<?php
session_start();
// Untuk memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

// Import database dan tampilan header
require_once '../Config/Database.php';
$page_title = 'Tiket Saya';
include '../Layout/User/HeaderUser.php';

// Ambil data tiket yang dibeli oleh pengguna yang sedang login dari VIEW
// View v_laporan_penjualan sudah menggabungkan data konser dan transaksi
$username_pengguna = $_SESSION['username'];
$query = "SELECT * FROM v_laporan_penjualan WHERE nama_pembeli = ? ORDER BY tanggal_pembelian DESC";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $username_pengguna);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);

?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Riwayat Pembelian Tiket Anda</h2>
    </div>

    <?php if (mysqli_num_rows($hasil) > 0): ?>
        <div class="list-group">
            <?php while ($tiket = mysqli_fetch_assoc($hasil)): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded-3 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-3 d-none d-md-flex align-items-center justify-content-center bg-light rounded-start p-3">
                            <i class="fa-solid fa-ticket-simple fa-5x text-primary opacity-50"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex w-100 justify-content-between p-3">
                                <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($tiket['nama_konser']); ?></h5>
                                <small class="text-muted"><?php echo date('d M Y', strtotime($tiket['tanggal_pembelian'])); ?></small>
                            </div>
                            <div class="px-3 pb-3">
                                <p class="mb-1 text-muted">
                                    <i class="fa-solid fa-microphone me-2"></i><?php echo htmlspecialchars($tiket['artis']); ?>
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold fs-5"><?php echo $tiket['jumlah_tiket']; ?> Tiket</span>
                                    </div>
                                    <div class="text-end">
                                        <small class="d-block text-muted">Total Pembayaran</small>
                                        <span class="fw-bold fs-5 text-success">Rp <?php echo number_format($tiket['total_harga'], 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fa-solid fa-ticket fa-3x text-muted mb-3"></i>
            <h4>Anda belum pernah membeli tiket.</h4>
            <p>Ayo cari konser seru dan beli tiketnya sekarang!</p>
            <a href="Beranda.php" class="btn btn-primary mt-2">Cari Konser</a>
        </div>
    <?php endif; ?>
</div>

<?php 
mysqli_stmt_close($stmt);
include '../Layout/User/FooterUser.php'; 
?>
