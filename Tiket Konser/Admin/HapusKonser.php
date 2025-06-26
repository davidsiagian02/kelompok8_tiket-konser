<?php
session_start();
// Pastikan ini adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../Auth/Login.php");
    exit;
}

require_once '../Config/Database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: Dashboard.php");
    exit;
}
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// 1. Cek dulu apakah ada transaksi yang terhubung dengan konser ini.
$cek_transaksi_query = "SELECT COUNT(*) as total FROM transaksi WHERE id_konser = $id";
$hasil_cek = mysqli_query($koneksi, $cek_transaksi_query);
$data_cek = mysqli_fetch_assoc($hasil_cek);

// 2. Jika total transaksi lebih dari 0, JANGAN HAPUS. Beri pesan error.
if ($data_cek['total'] > 0) {
    $_SESSION['pesan'] = [
        'tipe' => 'danger', 
        'isi' => 'Gagal menghapus! Konser ini sudah memiliki riwayat penjualan tiket. Anda tidak bisa menghapusnya untuk menjaga integritas data.'
    ];
} else {
    // 3. Jika tidak ada transaksi (aman), baru jalankan query DELETE.
    $query = "DELETE FROM konser WHERE id_konser = $id";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['pesan'] = ['tipe' => 'success', 'isi' => 'Data konser berhasil dihapus.'];
    } else {
        // Ini sebagai cadangan jika ada error lain
        $_SESSION['pesan'] = ['tipe' => 'danger', 'isi' => 'Gagal menghapus data: ' . mysqli_error($koneksi)];
    }
}

// 4. Arahkan kembali ke dashboard admin.
header("Location: Dashboard.php");
exit;
