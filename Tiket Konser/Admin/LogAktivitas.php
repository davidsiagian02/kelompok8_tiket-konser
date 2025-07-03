<?php
session_start();
// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../Auth/Login.php");
    exit;
}

require_once '../Config/Database.php';
$page_title = 'Log Aktivitas';
include '../Layout/Admin/HeaderAdmin.php';

// Ambil semua data dari tabel audit_log, diurutkan dari yang terbaru
$query = "SELECT * FROM audit_log ORDER BY waktu_perubahan DESC";
$hasil = mysqli_query($koneksi, $query);
?>

<h2 class="page-title mb-4">Log Aktivitas Sistem</h2>

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-history me-2"></i>Riwayat Perubahan Data Penting</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Waktu</th>
                        <th>Tabel</th>
                        <th>ID Record</th>
                        <th>Aksi</th>
                        <th>Deskripsi Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($hasil) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                            <tr>
                                <td data-label="Waktu" class="text-nowrap">
                                    <?php echo date('d M Y, H:i:s', strtotime($row['waktu_perubahan'])); ?>
                                </td>
                                <td data-label="Tabel"><?php echo htmlspecialchars($row['tabel_terdampak']); ?></td>
                                <td data-label="ID Record">#<?php echo $row['id_record_terdampak']; ?></td>
                                <td data-label="Aksi">
                                    <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($row['aksi']); ?></span>
                                </td>
                                <td data-label="Deskripsi"><?php echo htmlspecialchars($row['deskripsi_perubahan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                Belum ada aktivitas perubahan data yang tercatat.
                            </td>
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
