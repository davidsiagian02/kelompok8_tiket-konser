        <footer class="mt-4 text-center text-muted">
            <p>© <?php echo date('Y'); ?> TiketKu. Dibuat dengan Penuh Semangat.</p>
        </footer>

    </div>
</div>


<!-- Bootstrap JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    // Fungsi untuk konfirmasi penghapusan
    function konfirmasiHapus(url) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }
</script>
</body>
</html>
