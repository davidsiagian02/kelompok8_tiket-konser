<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../Auth/Login.php");
    exit;
}

require_once '../Config/Database.php';

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dan lakukan sanitasi
    $nama_konser = mysqli_real_escape_string($koneksi, $_POST['nama_konser']);
    $artis = mysqli_real_escape_string($koneksi, $_POST['artis']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $gambar_url = mysqli_real_escape_string($koneksi, $_POST['gambar_url']);
    $harga_tiket = mysqli_real_escape_string($koneksi, $_POST['harga_tiket']);
    $stok_tiket = mysqli_real_escape_string($koneksi, $_POST['stok_tiket']);

    // Query untuk memasukkan data baru ke tabel `konser`
    $query = "INSERT INTO konser (nama_konser, artis, tanggal, lokasi, gambar_url, harga_tiket, stok_tiket) 
              VALUES ('$nama_konser', '$artis', '$tanggal', '$lokasi', '$gambar_url', '$harga_tiket', '$stok_tiket')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Konser baru berhasil ditambahkan.'];
        header("Location: Dashboard.php");
        exit;
    } else {
        $error_message = "Gagal menambahkan konser: " . mysqli_error($koneksi);
    }
}

$page_title = 'Tambah Konser Baru';
include '../Layout/Admin/HeaderAdmin.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title"><i class="fa-solid fa-plus-circle"></i> Form Tambah Konser</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form action="TambahKonser.php" method="POST">
                    <div class="mb-3">
                        <label for="nama_konser" class="form-label">Nama Konser</label>
                        <input type="text" class="form-control" id="nama_konser" name="nama_konser" required>
                    </div>
                    <div class="mb-3">
                        <label for="artis" class="form-label">Artis / Bintang Tamu</label>
                        <input type="text" class="form-control" id="artis" name="artis" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_url" class="form-label">Link Gambar Konser</label>
                        <input type="url" class="form-control" id="gambar_url" name="gambar_url" placeholder="https://example.com/gambar.jpg">
                        <div class="form-text">Opsional. Masukkan URL gambar untuk poster konser.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga_tiket" class="form-label">Harga Tiket (Rp)</label>
                            <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" min="0" step="1000" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stok_tiket" class="form-label">Stok Tiket</label>
                            <input type="number" class="form-control" id="stok_tiket" name="stok_tiket" min="0" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="Dashboard.php" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../Layout/Admin/FooterAdmin.php';
?>
