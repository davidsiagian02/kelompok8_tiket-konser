<?php
// Halaman untuk membeli tiket (membuat entri di tabel transaksi)

require_once '../Config/Database.php';

// Cek jika ID konser ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: Dashboard.php");
    exit;
}
$id_konser = mysqli_real_escape_string($koneksi, $_GET['id']);

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pembeli = mysqli_real_escape_string($koneksi, $_POST['nama_pembeli']);
    $jumlah_tiket = mysqli_real_escape_string($koneksi, $_POST['jumlah_tiket']);

    // Query untuk insert ke tabel transaksi.
    // Kolom 'total_harga' dan update stok akan di-handle oleh TRIGGER di database.
    $query = "INSERT INTO transaksi (id_konser, nama_pembeli, jumlah_tiket) 
              VALUES ('$id_konser', '$nama_pembeli', '$jumlah_tiket')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Pembelian tiket berhasil!'];
        header("Location: LaporanPenjualan.php");
        exit;
    } else {
        // Tangkap pesan error dari trigger jika stok tidak cukup
        $error_message = mysqli_error($koneksi);
    }
}

// Ambil data konser yang akan dibeli tiketnya
$result = mysqli_query($koneksi, "SELECT * FROM konser WHERE id_konser = $id_konser");
if (mysqli_num_rows($result) == 0) {
    $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Konser tidak ditemukan.'];
    header("Location: Dashboard.php");
    exit;
}
$konser = mysqli_fetch_assoc($result);

$page_title = 'Beli Tiket';
include '../Layout/Admin/HeaderAdmin.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fa-solid fa-cart-shopping"></i> Form Pembelian Tiket</h4>
            </div>
            <div class="card-body">
                
                <!-- Menampilkan detail konser -->
                <h5>Detail Konser</h5>
                <dl class="row">
                    <dt class="col-sm-4">Nama Konser</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($konser['nama_konser']); ?></dd>
                    
                    <dt class="col-sm-4">Artis</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($konser['artis']); ?></dd>
                    
                    <dt class="col-sm-4">Harga per Tiket</dt>
                    <dd class="col-sm-8">Rp <?php echo number_format($konser['harga_tiket'], 0, ',', '.'); ?></dd>
                    
                    <dt class="col-sm-4">Sisa Stok</dt>
                    <dd class="col-sm-8"><?php echo number_format($konser['stok_tiket']); ?></dd>
                </dl>
                <hr>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>

                <form action="BeliTiket.php?id=<?php echo $id_konser; ?>" method="POST">
                    <div class="mb-3">
                        <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                        <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" min="1" max="<?php echo $konser['stok_tiket']; ?>" required>
                        <div class="form-text">
                            Stok tersedia: <?php echo $konser['stok_tiket']; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="Dashboard.php" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary" <?php echo ($konser['stok_tiket'] == 0) ? 'disabled' : ''; ?>>
                            <?php echo ($konser['stok_tiket'] == 0) ? 'Stok Habis' : 'Beli Sekarang'; ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../Layout/Admin/FooterAdmin.php';
?>
