<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../Config/Database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: Beranda.php");
    exit;
}
$id_konser = mysqli_real_escape_string($koneksi, $_GET['id']);

$error_message = '';
// Proses form pembelian
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah_tiket = mysqli_real_escape_string($koneksi, $_POST['jumlah_tiket']);
    $nama_pembeli = $_SESSION['username']; // Ambil nama dari session

    // Mulai transaksi database.
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Ambil data konser terbaru dan kunci barisnya agar tidak diubah oleh proses lain
        $stmt_konser = mysqli_prepare($koneksi, "SELECT harga_tiket, stok_tiket FROM konser WHERE id_konser = ? FOR UPDATE");
        mysqli_stmt_bind_param($stmt_konser, "i", $id_konser);
        mysqli_stmt_execute($stmt_konser);
        $result_konser = mysqli_stmt_get_result($stmt_konser);
        $konser_data = mysqli_fetch_assoc($result_konser);

        if (!$konser_data) {
            throw new Exception("Konser tidak ditemukan.");
        }

        // 2. Fungsi untuk menghitung stok apakah mencukupi
        if ($konser_data['stok_tiket'] < $jumlah_tiket) {
            throw new Exception("Maaf, stok tiket tidak mencukupi.");
        }

        // 3. Hitung total harga
        $total_harga = $konser_data['harga_tiket'] * $jumlah_tiket;

        // 4. Jika tiket berhasil terbeli, maka stok akan dikurangi
        $stok_baru = $konser_data['stok_tiket'] - $jumlah_tiket;

        // 5. Masukkan data ke tabel transaksi
        $stmt_insert = mysqli_prepare($koneksi, "INSERT INTO transaksi (id_konser, nama_pembeli, jumlah_tiket, total_harga) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_insert, "isid", $id_konser, $nama_pembeli, $jumlah_tiket, $total_harga);
        mysqli_stmt_execute($stmt_insert);

        // 6. Update stok di tabel konser
        $stmt_update = mysqli_prepare($koneksi, "UPDATE daftarkonser SET stok_tiket = ? WHERE id_konser = ?");
        mysqli_stmt_bind_param($stmt_update, "ii", $stok_baru, $id_konser);
        mysqli_stmt_execute($stmt_update);
        
        // Jika semua telah berhasil
        mysqli_commit($koneksi);
        
        // Tampilkan halaman sukses
        $page_title = 'Pembelian Berhasil';
        include '../Layout/User/HeaderUser.php';
        echo '<div class="container text-center my-5 py-5"><div class="card col-md-6 mx-auto shadow"><div class="card-body p-5"><i class="fa-solid fa-circle-check fa-5x text-success mb-4"></i><h2 class="card-title">Pembelian Berhasil!</h2><p>Terima kasih, '.htmlspecialchars($nama_pembeli).'. Tiket Anda telah diproses.</p><a href="Beranda.php" class="btn btn-primary">Kembali ke Beranda</a></div></div></div>';
        include '../Layout/User/FooterUser.php';
        exit;

    } catch (Exception $e) {
        // Jika ada masalah, batalkan semua perubahan
        mysqli_rollback($koneksi);
        $error_message = $e->getMessage();
    }
}

// Ambil data konser untuk ditampilkan di form
$result = mysqli_query($koneksi, "SELECT * FROM daftarkonser WHERE id_konser = $id_konser");
if (mysqli_num_rows($result) == 0) {
    header("Location: Beranda.php");
    exit;
}
$konser = mysqli_fetch_assoc($result);

$page_title = 'Pesan Tiket: ' . htmlspecialchars($konser['nama_konser']);
include '../Layout/User/HeaderUser.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h2 class="mb-4">Form Pemesanan Tiket</h2>
                    <hr class="mb-4">
                    
                    <h5>Detail Konser</h5>
                    <dl class="row mb-4">
                        <dt class="col-sm-4">Nama Konser</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($konser['nama_konser']); ?></dd>
                        <dt class="col-sm-4">Artis</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($konser['artis']); ?></dd>
                        <dt class="col-sm-4">Harga per Tiket</dt>
                        <dd class="col-sm-8 fw-bold">Rp <?php echo number_format($konser['harga_tiket'], 0, ',', '.'); ?></dd>
                    </dl>

                    <form action="PesanTiket.php?id=<?php echo $id_konser; ?>" method="POST">
                        <?php if(!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                            <input type="text" class="form-control" id="nama_pembeli" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" disabled readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" min="1" max="<?php echo $konser['stok_tiket']; ?>" required>
                            <div class="form-text">Stok tersedia: <?php echo $konser['stok_tiket']; ?></div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="Beranda.php" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold" <?php echo ($konser['stok_tiket'] == 0) ? 'disabled' : ''; ?>>
                                <i class="fa-solid fa-check me-2"></i> Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../Layout/User/FooterUser.php'; ?>
