<?php
require_once '../Config/Database.php';
$page_title = 'Laporan Penjualan Tiket';
include '../Layout/Admin/HeaderAdmin.php';

// Mengambil data dari tabel v_laporan_penjualan
$query = "SELECT * FROM v_laporan_penjualan";
$hasil = mysqli_query($koneksi, $query);
?>

<h1 class="page-title mb-4">Laporan Penjualan</h1>

<div class="card">
    <div class="card-header">
        <h5><i class="fa-solid fa-file-invoice-dollar me-2"></i> Rincian Penjualan Tiket</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Konser</th>
                        <th>Nama Pembeli</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tgl Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($hasil) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                            <tr>
                                <td data-label="ID Transaksi">#<?php echo $row['id_transaksi']; ?></td>
                                <td data-label="Konser"><?php echo htmlspecialchars($row['nama_konser']); ?></td>
                                <td data-label="Pembeli"><?php echo htmlspecialchars($row['nama_pembeli']); ?></td>
                                <td data-label="Jumlah"><?php echo $row['jumlah_tiket']; ?></td>
                                <td data-label="Total Harga">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td data-label="Tanggal"><?php echo date('d M Y, H:i', strtotime($row['tanggal_pembelian'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center p-4">Belum ada data penjualan tiket.</td>
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
