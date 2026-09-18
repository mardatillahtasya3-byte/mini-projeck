# 🛒 Product Information System

Sistem Informasi Inventaris Produk berbasis web sederhana yang dibangun menggunakan **PHP Native** tanpa *framework*. Proyek ini menerapkan konsep pemisahan komponen (*Separation of Concerns*), autentikasi pengguna, serta pengelolaan data berbasis **JSON**[span_0](start_span)[span_0](end_span).

---

##Fitur Utama

- **Sistem Autentikasi**: Fitur Registrasi (`register.php`), Login (`login.php`), dan Logout (`logout.php`).
- **Pengelolaan Data (JSON)**: Data produk (`products_data.json`) dan data pengguna (`users_data.json`) tersimpan secara terstruktur dalam format JSON.
- **Dashboard Inventaris**: Menampilkan tabel produk beserta kalkulasi total nilai inventaris secara otomatis[span_1](start_span)[span_1](end_span)[span_2](start_span)[span_2](end_span).
- **Indikator Stok Kritis**: Penandaan warna khusus (*badge*) untuk produk yang memiliki stok menipis (< 3) atau habis[span_3](start_span)[span_3](end_span)[span_4](start_span)[span_4](end_span).
- **Tambah & Detail Produk**: Form penambahan produk baru (`tambah_produk.php`) dan halaman rincian informasi produk (`lihat_produk.php`).

---

##Struktur Proyek

```text
MINI-PROJECT/
├── README.md             # Dokumentasi proyek
├── functions.php          # Logika bisnis, pemrosesan JSON, dan fungsi autentikasi
├── index.php              # Halaman utama (Dashboard)
├── lihat_produk.php       # Halaman rincian detail produk
├── login.php              # Halaman login pengguna
├── logout.php             # Script untuk mengakhiri sesi login
├── products_data.json     # File penyimpanan data produk (JSON)
├── register.php           # Halaman pendaftaran pengguna baru
├── tambah_produk.php      # Form penambahan produk baru
└── users_data.json        # File penyimpanan data akun pengguna (JSON)