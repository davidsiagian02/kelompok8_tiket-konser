<?php
/**
 * File konfigurasi database
 * Berisi detail untuk koneksi ke server MySQL.
 */

// Detail koneksi
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; 
$db_name = 'db_tiket_konser';

// Membuat koneksi ke database menggunakan mysqli
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi (Jika gagal, hentikan script dan tampilkan pesan error)
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Set timezone default
date_default_timezone_set('Asia/Jakarta');

?>
