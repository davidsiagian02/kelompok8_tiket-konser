<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonserKita - Tiket Konser Online</title>
    <!-- Import Style -->
    <link rel="stylesheet" href="../css/colors.css">
    <link rel="stylesheet" href="../css/layout-user.css">

    <!-- Import Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Icons Website -->
    <link rel="icon" type="image" href="../assets/logo_ticket.png">
</head>
<body>
    <header id="navbar" class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="#" class="logo">e-Tiket<span>Konser</span></a>
                
                <nav class="nav-links">
                    <a href="#">Beranda</a>
                    <a href="#konser">Konser</a>
                    <a href="#tentang-kami">Tentang Kami</a>
                    <a href="#kontak">Kontak</a>
                </nav>

                <div class="nav-actions">
                    <a href="#" class="btn-login">Masuk</a>
                    <a href="#" class="btn btn-primary">Daftar</a>
                </div>

                <button id="mobile-menu-button" class="mobile-menu-button">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="mobile-menu">
        <div class="mobile-menu-header">
            <a href="#" class="logo">Konser<span>Kita</span></a>
            <button id="close-menu-button">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <nav class="mobile-nav-links">
            <a href="#">Beranda</a>
            <a href="#konser">Konser</a>
            <a href="#tentang-kami">Tentang Kami</a>
            <a href="#kontak">Kontak</a>
        </nav>
        <div class="mobile-menu-actions">
            <a href="#" class="btn btn-outline">Masuk</a>
            <a href="#" class="btn btn-primary">Daftar</a>
        </div>
    </div>


    <main>
        <section class="hero">
            <div class="container fade-in-up">
                <h1>Temukan & Pesan Tiket Konser Impianmu</h1>
                <p>Jelajahi ratusan acara musik dari artis favoritmu di seluruh Indonesia. Pengalaman tak terlupakan menantimu.</p>
                <div class="hero-buttons">
                     <a href="#konser" class="btn btn-primary">Jelajahi Konser</a>
                     <a href="#" class="btn btn-transparent">Jadi Partner</a>
                </div>
            </div>
        </section>

        <section id="konser" class="section">
            <div class="container">
                <div class="section-header fade-in-up">
                    <h2>Konser Terdekat</h2>
                    <p>Jangan sampai ketinggalan acara yang paling dinanti!</p>
                </div>

                <div class="concert-grid">

                    <div class="concert-card fade-in-up">
                        <img src="https://placehold.co/600x400/00ADB5/ffffff?text=Konser+Pop" alt="Poster Konser Pop" onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/ffffff?text=Image+Error';">
                        <div class="card-content">
                            <h3>Pop Fest 2025</h3>
                            <p class="artists">Sheila On 7, Tulus, Raisa</p>
                            <div class="card-info">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>25 Agustus 2025</span>
                            </div>
                            <div class="card-info">
                               <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>GBK, Jakarta</span>
                            </div>
                            <button class="btn btn-primary">Beli Tiket</button>
                        </div>
                    </div>

                    <div class="concert-card fade-in-up" data-wow-delay="0.2s">
                        <img src="https://placehold.co/600x400/393E46/ffffff?text=Konser+Rock" alt="Poster Konser Rock" onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/ffffff?text=Image+Error';">
                        <div class="card-content">
                            <h3>Distorsi Maksimal</h3>
                            <p class="artists">Dewa 19, Slank, Burgerkill</p>
                            <div class="card-info">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>15 September 2025</span>
                            </div>
                            <div class="card-info">
                               <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Stadion Siliwangi, Bandung</span>
                            </div>
                            <button class="btn btn-primary">Beli Tiket</button>
                        </div>
                    </div>

                    <div class="concert-card fade-in-up" data-wow-delay="0.4s">
                        <img src="https://placehold.co/600x400/A7D9FF/222831?text=Konser+Jazz" alt="Poster Konser Jazz" onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/ffffff?text=Image+Error';">
                        <div class="card-content">
                            <h3>Java Jazz Festival</h3>
                            <p class="artists">Ardhito Pramono, Maliq & D'Essentials</p>
                            <div class="card-info">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>1-3 Oktober 2025</span>
                            </div>
                            <div class="card-info">
                               <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>JIExpo Kemayoran, Jakarta</span>
                            </div>
                            <button class="btn btn-primary">Beli Tiket</button>
                        </div>
                    </div>
                </div>
                 <div class="view-all-btn fade-in-up">
                    <a href="#" class="btn btn-secondary">Lihat Semua Konser</a>
                </div>
            </div>
        </section>

        <section id="tentang-kami" class="section section-alt">
            <div class="container">
                <div class="section-header fade-in-up">
                    <h2>Tentang KonserKita</h2>
                    <p>Menghubungkan penggemar dengan musik live yang tak terlupakan sejak 2024.</p>
                </div>
                <div class="about-grid">
                    <div class="about-image-container fade-in-up">
                        <img src="https://placehold.co/800x600/222831/A7D9FF?text=Tim+Kami" alt="Tim KonserKita" class="about-image">
                    </div>
                    <div class="about-content fade-in-up" data-wow-delay="0.2s">
                        <h3>Misi Kami Adalah Kebahagiaan Anda</h3>
                        <p>KonserKita lahir dari kecintaan kami terhadap musik dan energi luar biasa yang tercipta dari sebuah pertunjukan live. Kami percaya bahwa setiap orang berhak mendapatkan akses yang mudah, aman, dan terpercaya untuk menghadiri konser artis idola mereka.</p>
                        <p>Kami lebih dari sekadar platform tiket; kami adalah jembatan antara artis dan penggemar, menciptakan momen yang akan dikenang seumur hidup. Dengan teknologi terdepan dan layanan pelanggan yang berdedikasi, kami berusaha untuk menjadi teman terbaik Anda dalam setiap petualangan musik.</p>
                        <a href="#konser" class="btn btn-primary">Temukan Konser Berikutnya</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="section">
            <div class="container">
                <div class="section-header fade-in-up">
                    <h2>Hubungi Kami</h2>
                    <p>Punya pertanyaan atau butuh bantuan? Tim kami siap membantu Anda.</p>
                </div>
                <div class="contact-grid">
                    <div class="contact-info fade-in-up">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div class="contact-info-content">
                                <h4>Alamat Kantor</h4>
                                <p>Jl. Jend. Sudirman No. 8, Jakarta Pusat, Indonesia</p>
                            </div>
                        </div>
                         <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            </div>
                            <div class="contact-info-content">
                                <h4>Email</h4>
                                <p>support@konserkita.com</p>
                            </div>
                        </div>
                         <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.211-.992-.58-1.355L16.5 16.5m-5.25 2.25A15.935 15.935 0 013.75 6.75m9-3.75a15.935 15.935 0 016 6.75" /></svg>
                            </div>
                            <div class="contact-info-content">
                                <h4>Telepon</h4>
                                <p>(021) 123-4567</p>
                            </div>
                        </div>
                    </div>
                    <form action="#" class="contact-form fade-in-up" data-wow-delay="0.2s">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan Anda</label>
                            <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <h3 class="logo">Konser<span>Kita</span></h3>
                    <p>Platform terdepan untuk menemukan dan membeli tiket konser musik di Indonesia. Kami berkomitmen memberikan pengalaman terbaik bagi para penikmat musik.</p>
                </div>
                <div>
                    <h4 class="font-semibold">Navigasi</h4>
                    <ul class="footer-links">
                        <li><a href="#tentang-kami">Tentang Kami</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Partner</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold">Bantuan</h4>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#kontak">Hubungi Kami</a></li>
                         <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold">Ikuti Kami</h4>
                    <div class="social-links">
                        <a href="#">
                           <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.494v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"></path></svg>
                        </a>
                        <a href="#">
                             <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z"></path></svg>
                        </a>
                         <a href="#">
                             <svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616v.064c0 2.298 1.634 4.215 3.791 4.649-.69.188-1.436.233-2.203.084.616 1.924 2.441 3.262 4.6 3.301-1.713 1.348-3.868 2.15-6.225 2.15-.404 0-.802-.025-1.195-.07 2.209 1.423 4.84 2.253 7.618 2.253 9.138 0 14.122-7.563 13.842-14.433.973-.702 1.815-1.579 2.483-2.578z"></path></svg>
                         </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2025 KonserKita. Dibuat dengan ❤ oleh Kelompok 8.
            </div>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
