<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Auth/Login.php");
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

    $query = "INSERT INTO transaksi (id_konser, nama_pembeli, jumlah_tiket) 
              VALUES ('$id_konser', '$nama_pembeli', '$jumlah_tiket')";

    if (mysqli_query($koneksi, $query)) {
        // Tampilkan halaman sukses
        $page_title = 'Pembelian Berhasil';
        include '../Layout/User/HeaderUser.php';
        echo '<div class="container text-center my-5 py-5">
                <div class="card col-md-6 mx-auto shadow">
                    <div class="card-body p-5">
                        <i class="fa-solid fa-circle-check fa-5x text-success mb-4"></i>
                        <h2 class="card-title">Pembelian Berhasil!</h2>
                        <p>Terima kasih, '.htmlspecialchars($nama_pembeli).'. Tiket Anda telah diproses.</p>
                        <a href="Beranda.php" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>
              </div>';
        include '../Layout/User/FooterUser.php';
        exit;
    } else {
        $error_message = mysqli_error($koneksi);
    }
}


// Ambil data konser
$result = mysqli_query($koneksi, "SELECT * FROM konser WHERE id_konser = $id_konser");
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
