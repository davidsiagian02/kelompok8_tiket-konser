<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

require_once '../Config/Database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: Dashboard.php");
    exit;
}
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_konser = mysqli_real_escape_string($koneksi, $_POST['nama_konser']);
    $artis = mysqli_real_escape_string($koneksi, $_POST['artis']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $gambar_url = mysqli_real_escape_string($koneksi, $_POST['gambar_url']);
    $harga_tiket = mysqli_real_escape_string($koneksi, $_POST['harga_tiket']);
    $stok_tiket = mysqli_real_escape_string($koneksi, $_POST['stok_tiket']);
    
    // Query UPDATE di tabel 'konser'
    $query = "UPDATE daftarkonser SET 
                nama_konser = '$nama_konser', 
                artis = '$artis', 
                tanggal = '$tanggal', 
                lokasi = '$lokasi', 
                gambar_url = '$gambar_url',
                harga_tiket = '$harga_tiket', 
                stok_tiket = '$stok_tiket' 
              WHERE id_konser = $id";
              
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data konser berhasil diperbarui.'];
        header("Location: Dashboard.php");
        exit;
    } else {
        $error_message = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

// Ambil data konser yang ada untuk ditampilkan di form
$result = mysqli_query($koneksi, "SELECT * FROM konser WHERE id_konser = $id");
if (mysqli_num_rows($result) == 0) {
    $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Data konser tidak ditemukan.'];
    header("Location: Dashboard.php");
    exit;
}
$data = mysqli_fetch_assoc($result);

$page_title = 'Edit Konser';
include '../Layout/Admin/HeaderAdmin.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title"><i class="fa-solid fa-pen-to-square"></i> Form Edit Konser</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="EditKonser.php?id=<?php echo $id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="nama_konser" class="form-label">Nama Konser</label>
                        <input type="text" class="form-control" id="nama_konser" name="nama_konser" value="<?php echo htmlspecialchars($data['nama_konser']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="artis" class="form-label">Artis / Bintang Tamu</label>
                        <input type="text" class="form-control" id="artis" name="artis" value="<?php echo htmlspecialchars($data['artis']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo htmlspecialchars($data['lokasi']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_url" class="form-label">Link Gambar Konser</label>
                        <input type="url" class="form-control" id="gambar_url" name="gambar_url" placeholder="https://example.com/gambar.jpg" value="<?php echo htmlspecialchars($data['gambar_url']); ?>">
                    </div>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga_ tiket" class="form-label">Harga Tiket (Rp)</label>
                            <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" value="<?php echo $data['harga_tiket']; ?>" min="0" step="1000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stok_tiket" class="form-label">Stok Tiket</label>
                            <input type="number" class="form-control" id="stok_tiket" name="stok_tiket" value="<?php echo $data['stok_tiket']; ?>" min="0" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="Dashboard.php" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../Layout/Admin/FooterAdmin.php';
?>
