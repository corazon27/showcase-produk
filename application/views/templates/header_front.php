<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow"> <?php
    $site_name = "CV. ABADI JAYA MITRA";
    if (isset($produk) && isset($produk['nama_barang'])) {
        $clean_title = $produk['nama_barang'];
        $og_title = $clean_title . " - " . $site_name;
        $og_image = base_url('assets/img/produk/' . $produk['foto_barang']);
        
        $bersih = strip_tags($produk['deskripsi_singkat']);
        $ringkasan = mb_strimwidth($bersih, 0, 160, "..."); // Google suka max 160 karakter
        
        $og_desc = "Cari " . $clean_title . "? Tersedia di " . $site_name . ". " . $ringkasan;
        $og_type = "product";
        $keywords = $clean_title . ", pengadaan atk, supplier " . $clean_title . ", " . $site_name;
    } else {
        $og_title = $site_name . " - Solusi Pengadaan Barang Kantor";
        $og_image = base_url('assets/img/logo_ajm.png');
        $og_desc = "Mitra terpercaya pengadaan Alat Tulis Kantor (ATK) dan perangkat elektronik untuk instansi pemerintah & swasta.";
        $og_type = "website";
        $keywords = "pengadaan atk, supplier kantor magelang, cv abadi jaya mitra, alat tulis kantor";
    }
?>

    <title><?= $og_title; ?></title>
    <meta name="description" content="<?= $og_desc; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <link rel="canonical" href="<?= current_url(); ?>" />

    <meta property="og:site_name" content="<?= $site_name; ?>">
    <meta property="og:title" content="<?= $og_title; ?>" />
    <meta property="og:description" content="<?= $og_desc; ?>" />
    <meta property="og:image" content="<?= $og_image; ?>" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:type" content="<?= $og_type; ?>" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $og_title; ?>">
    <meta name="twitter:description" content="<?= $og_desc; ?>">
    <meta name="twitter:image" content="<?= $og_image; ?>">

    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo_ajm.png'); ?>">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "LocalBusiness",
        "name": "CV. ABADI JAYA MITRA",
        "image": "<?= base_url('assets/img/logo_ajm.png'); ?>",
        "@id": "<?= base_url(); ?>",
        "url": "<?= base_url(); ?>",
        "telephone": "+6282136405274",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Perum Bumi Nusantara 1",
            "addressLocality": "Magelang",
            "addressRegion": "Jawa Tengah",
            "postalCode": "56172",
            "addressCountry": "ID"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": -7.48,
            "longitude": 110.22
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday"
            ],
            "opens": "08:00",
            "closes": "17:00"
        }
    }
    </script>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <style>
    :root {
        --primary-color: #0d6efd;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Navbar Modern Floating */
    .navbar {
        background: rgba(255, 255, 255, 0.85) !important;
        /* Transparansi */
        backdrop-filter: blur(10px);
        /* Efek blur kaca */
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    /* Link Navigasi dengan Efek Underline Modern */
    .nav-link {
        position: relative;
        font-weight: 500;
        margin: 0 5px;
        color: #333 !important;
    }

    .nav-link.active {
        background: rgba(13, 110, 253, 0.08);
        /* Biru sangat muda */
        color: #0d6efd !important;
        border-radius: 50px;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 5px;
        left: 50%;
        background-color: #0d6efd;
        /* Warna biru primer */
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 20px;
        /* Garis muncul kecil di tengah saat hover */
    }

    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
        background: #fff;
        height: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .category-badge {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: var(--primary-color);
        font-weight: bold;
    }

    .btn-whatsapp {
        background-color: #25d366;
        /* Warna Hijau WA */
        color: white;
        border-radius: 50px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        /* Transisi halus */
        border: none;
    }

    /* EFEK HOVER (Saat Mouse di Atas Tombol) */
    .btn-whatsapp:hover {
        background-color: #128c7e !important;
        /* Hijau yang lebih gelap */
        color: white !important;
        transform: translateY(-3px);
        /* Tombol sedikit terangkat (keren) */
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
        /* Efek cahaya hijau */
    }

    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .rounded-pill-start {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px !important;
    }

    .rounded-pill-end {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
    }

    /* Tambahkan di bagian <style> landing_page.php */
    .view-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.8);
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: bold;
        color: #666;
        backdrop-filter: blur(4px);
    }

    /* Warna dasar tombol Kembali (Biru) */
    /* Styling Tombol Utama */
    .btn-back-home {
        background-color: #0d6efd;
        color: white !important;
        border: none;
        font-weight: 600;
        padding: 8px 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-back-home:hover {
        background-color: #0a58ca !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3) !important;
    }

    /* Efek Klik */
    .btn-back-home:active {
        transform: scale(0.95);
    }

    .view-badge-mobile {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.8);
        /* Putih transparan */
        backdrop-filter: blur(4px);
        /* Efek kaca kekinian */
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: bold;
        color: #666;
        z-index: 5;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Styling Tombol Load More Modern */
    .btn-load-more {
        background: transparent;
        color: var(--primary-color) !important;
        border: 2px solid var(--primary-color);
        font-weight: 700;
        padding: 12px 40px;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
    }

    .btn-load-more:hover {
        background-color: var(--primary-color);
        color: white !important;
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
    }

    .btn-load-more:active {
        transform: scale(0.95);
    }

    /* Efek Kilauan (Shimmer) */
    .btn-load-more::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 20%;
        height: 200%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(30deg);
        transition: all 0.7s;
    }

    .btn-load-more:hover::after {
        left: 120%;
    }

    /* Container untuk pesan 'Habis' */
    #no-more-msg {
        font-weight: 500;
        background: #e9ecef;
        display: inline-block;
        padding: 8px 20px;
        border-radius: 50px;
    }

    /* Hilangkan counter lama yang bikin penuh di HP */
    @media (max-width: 767px) {
        .category-badge {
            font-size: 0.65rem;
            /* Sedikit dikecilkan agar tidak makan tempat */
        }
    }

    /* RESPONSIVE ADJUSTMENT */
    @media (max-width: 767px) {

        /* Menghilangkan garis biru vertikal di HP agar judul lebih ke kiri */
        .bg-primary {
            display: none;
        }

        /* Judul lebih proporsional di HP */
        h3.fs-4 {
            font-size: 1.3rem !important;
            line-height: 1.4;
        }

        /* Pembungkus tombol dipaksa lebar penuh */
        .w-100-mobile {
            width: 100%;
        }

        /* Tombol Biru memanjang (Full Width) seperti foto image_28d909.png */
        .btn-back-home {
            width: 100%;
            padding: 12px !important;
            /* Lebih tinggi agar mudah ditekan */
            font-size: 0.95rem;
            margin-top: 5px;
        }
    }

    @media (max-width: 767px) {

        /* Kecilkan padding card-body agar teks tidak sesak */
        .card-body {
            padding: 10px !important;
        }

        /* Sesuaikan tinggi gambar agar seragam */
        .product-img {
            height: 140px !important;
        }

        /* Kecilkan ukuran judul barang */
        .product-card h5 {
            font-size: 0.9rem !important;
            margin-bottom: 5px !important;
        }

        /* Kecilkan teks tombol WA */
        .btn-whatsapp {
            font-size: 0.8rem !important;
            padding: 8px 5px !important;
        }

        /* Sembunyikan deskripsi singkat di HP jika terlalu panjang */
        .product-card p.text-muted {
            display: none;
        }

        /* Atur jarak antar kolom agar lebih rapat seperti Barokah Motor */
        .row.g-4 {
            --bs-gutter-x: 0.5rem;
            /* Jarak horizontal dipersempit */
        }
    }

    /* Container Utama */
    .search-wrapper {
        position: relative;
        z-index: 100;
    }

    /* Panel Keywords (Hidden by Default) */
    .hot-keywords-dropdown {
        position: absolute;
        top: 100%;
        left: 20px;
        right: 20px;
        background: white;
        border-radius: 0 0 20px 20px;
        margin-top: -25px;
        /* Menyelip di belakang search bar */
        padding-top: 25px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-20px);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: -1;
        border: 1px solid #eee;
    }

    /* State Aktif saat Search di Klik */
    .search-wrapper.active .hot-keywords-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        z-index: 1;
    }

    /* Styling Badge Keyword yang Lebih Modern */
    .btn-keyword {
        display: inline-block;
        padding: 6px 16px;
        background: #f8f9fa;
        color: #555;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #eee;
        transition: all 0.2s;
    }

    .btn-keyword:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .suggest-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #f8f9fa;
        transition: background 0.2s;
        font-size: 0.95rem;
    }

    .suggest-item:hover {
        background-color: #f1f4f9;
        color: var(--primary-color);
    }

    .suggest-item:last-child {
        border-bottom: none;
        border-radius: 0 0 20px 20px;
    }

    .navbar-detail {
        background: white;
        border-bottom: 1px solid #eee;
    }

    .product-main-img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .spec-label {
        color: #6c757d;
        width: 35%;
    }

    .spec-value {
        font-weight: 600;
        color: #212529;
    }

    .btn-whatsapp-detail {
        background-color: #25d366;
        color: white;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-whatsapp-detail:hover {
        background-color: #128c7e;
        color: white;
        transform: scale(1.02);
    }

    /* Gaya Tombol Sebar Produk (Vibe TikTok/Social) */
    .btn-share-custom {
        background-color: #0d6efd;
        color: #495057;
        border: 1px solid #0d6efd;
        transition: all 0.3s ease;
    }

    .btn-share-custom:hover {
        background-color: #0d6efd;
        /* Biru Primer */
        color: white;
        border-color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    /* Gaya Tombol QR Code (Vibe Teknologi) */
    .btn-qr-custom {
        background-color: #e7f1ff;
        color: #0d6efd;
        border: 1px solid #cfe2ff;
        transition: all 0.3s ease;
    }

    .btn-qr-custom:hover {
        background-color: #0a58ca;
        /* Biru Gelap */
        color: white;
        border-color: #0a58ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(10, 88, 202, 0.2);
    }

    /* Atur tinggi gambar agar seragam & rapi */
    .product-img-swiper {
        width: 100%;
        height: 450px;
        /* Tinggi di Laptop/PC */
        object-fit: cover;
        display: block;
        background-color: #f8f9fa;
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .product-img-swiper {
            height: 350px;
            /* Tinggi di HP */
        }
    }

    /* --- Styling Dots (Pagination) Custom --- */

    /* Titik Biasa (Belum Aktif) */
    /* Pastikan ini menggantikan gaya lama agar tidak ada kotak-kotak lagi */
    .swiper-pagination-custom {
        text-align: center;
        margin-top: 15px;
    }

    .swiper-pagination-custom .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #e0e0e0;
        opacity: 1;
        margin: 0 5px !important;
        border-radius: 50%;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .swiper-pagination-custom .swiper-pagination-bullet-active {
        background: #198754;
        /* Hijau Barokah Motor */
        transform: scale(1.2);
    }

    .product-img-swiper {
        /* Tambahkan dua baris ini di dalam class gambar kamu */
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;

        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    /* Menghilangkan border bawaan bootstrap pada tab container */
    .nav-tabs-new {
        border-bottom: 2px solid #eee;
        /* Garis abu-abu tipis sebagai dasar */
    }

    .nav-tabs-new .nav-link-new {
        background: none !important;
        /* Menghilangkan warna putih/abu saat aktif */
        border: none !important;
        /* Menghilangkan kotak border */
        color: #6c757d;
        /* Warna teks default (abu-abu) */
        font-weight: 600;
        padding: 10px 20px;
        position: relative;
        transition: color 0.3s ease;
    }

    /* Saat Tab Aktif */
    .nav-tabs-new .nav-link-new.active {
        color: #dc3545 !important;
        /* Warna teks jadi merah */
        background: none !important;
        /* Memastikan tidak ada background putih */
    }

    /* Membuat garis merah yang presisi di bawah teks saja */
    .nav-tabs-new .nav-link-new.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        /* Menempel tepat di atas border-bottom container */
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #dc3545;
        border-radius: 10px;
    }

    .nav-tabs-new .nav-link-new:hover {
        color: #dc3545;
    }

    .tab-content h4 {
        font-size: 1.5rem;
        color: #000;
    }

    /* Styling Tabel Spesifikasi agar mirip gambar */
    .table-spec-custom {
        border: 1px solid #dee2e6 !important;
    }

    .table-spec-custom td {
        padding: 12px 20px;
        vertical-align: middle;
        border: 1px solid #dee2e6 !important;
    }

    /* Mewarnai kolom label menjadi abu-abu */
    .label-column {
        background-color: #f8f9fa !important;
        /* Warna abu-abu terang */
        width: 30%;
        /* Mengatur lebar kolom label */
        font-weight: 500;
        color: #333;
    }

    /* Memastikan kolom value tetap putih */
    .value-column {
        background-color: #ffffff !important;
        color: #555;
    }

    /* Tambahkan di dalam <style> detail_produk.php */
    .search-wrapper {
        position: relative;
        width: 100%;
    }

    /* Panel Dropdown - Animasi Slide */
    .hot-keywords-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 20px;
        margin-top: 10px;
        padding: 10px 0;

        /* Gunakan ini untuk sembunyi tapi tetap bisa dianimasikan */
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px) scale(0.98);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);

        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        z-index: 9999;
    }

    /* Saat aktif (muncul) */
    .hot-keywords-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
    }

    /* Pastikan Suggestion Results tidak tersembunyi secara permanen */
    #suggestion-results {
        display: block;
        /* Biarkan JS yang mengatur kontennya */
    }

    /* Styling Badge Hot Keyword di Halaman Detail */
    .btn-keyword {
        display: inline-block;
        padding: 6px 14px;
        background-color: #f1f3f5;
        /* Abu-abu muda default */
        color: #495057;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid transparent;
    }

    /* Efek Hover: Berubah warna dan sedikit terangkat */
    .btn-keyword:hover {
        background-color: var(--primary-color);
        /* Merah (sesuai tema garis tab kamu) */
        color: white !important;
        transform: translateY(-2px);
        /* Efek melayang */
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
        /* Shadow halus warna merah */
        border-color: var(--primary-color);
    }

    /* Efek saat diklik */
    .btn-keyword:active {
        transform: translateY(0);
    }

    .suggest-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        text-decoration: none;
        border-bottom: 1px solid #f8f9fa;
        transition: 0.2s;
    }

    .suggest-item:hover {
        background: #f8f9fa;
    }

    .filter-section {
        background: #ffffff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 40px;
    }

    /* Styling Dasar */
    .select-custom {
        cursor: pointer;
        outline: none;
        box-shadow: none !important;
        font-size: 14px;
        /* Min-width desktop agar tidak terlalu gepeng */
        min-width: 140px;
    }

    /* KHUSUS HP (Max-width 768px) */
    @media (max-width: 768px) {
        .select-custom {
            font-size: 13px;
            min-width: 0;
            /* Di HP jangan dipaksa lebar minimum, biarkan flex yang atur */
        }

        /* Memastikan info text tidak nempel banget dengan filter di HP */
        .text-start {
            margin-top: 5px;
        }
    }

    /* Animasi mengangkat card */
    .product-card-hover {
        transition: all 0.3s ease-in-out;
    }

    .product-card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }

    /* Efek zoom pada gambar */
    .img-wrapper-custom {
        overflow: hidden;
        /* Supaya gambar tidak keluar batas saat di-zoom */
    }

    .product-card-hover img {
        transition: transform 0.5s ease;
    }

    .product-card-hover:hover img {
        transform: scale(1.1);
    }

    /* Class Baru untuk Tombol Navigasi Section */
    .btn-nav-more {
        display: inline-flex;
        align-items: center;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
        color: #0d6efd;
        background-color: #0d6efd;
        border: 1.5px solid #0d6efd;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-nav-more:hover {
        background-color: #0d6efd;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        transform: translateY(-2px);
    }

    .btn-nav-more i {
        transition: transform 0.3s ease;
    }

    .btn-nav-more:hover i {
        transform: translateX(3px);
        /* Panah bergerak sedikit ke kanan saat hover */
    }

    /* Responsif Layar HP (Mobile) */
    @media (max-width: 576px) {
        .btn-nav-more {
            padding: 6px 12px;
            /* Padding lebih kecil di HP */
            font-size: 11px;
            /* Font lebih kecil agar tidak makan tempat */
        }

        .section-header-title {
            font-size: 1.1rem;
            /* Ukuran judul section disesuaikan */
        }
    }

    /* Container Tombol WA Melayang */
    .floating-wa {
        position: fixed;
        bottom: 30px;
        /* Jarak dari bawah */
        right: 30px;
        /* Jarak dari kanan */
        background-color: #25d366;
        color: white !important;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        text-align: center;
        font-size: 35px;
        box-shadow: 2px 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        /* Pastikan di atas elemen lain */
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .floating-wa:hover {
        transform: scale(1.1);
        background-color: #128c7e;
    }

    .wa-circle {
        position: fixed !important;
        bottom: 30px !important;
        right: 30px !important;
        left: auto !important;
        background-color: #25d366;
        color: white !important;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: none;
        /* SEMBUNYIKAN AWALNYA */
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 2px 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 99999;
        transition: opacity 0.3s ease-in-out;
        text-decoration: none;
    }

    /* Animasi Denyut (Pulse) */
    .wa-circle::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #25d366;
        border-radius: 50%;
        z-index: -1;
        animation: wa-pulse 2s infinite;
    }

    @keyframes wa-pulse {
        0% {
            transform: scale(1);
            opacity: 0.5;
        }

        100% {
            transform: scale(1.6);
            opacity: 0;
        }
    }

    .wa-circle:hover {
        transform: scale(1.1);
        color: white;
        background-color: #128c7e;
    }

    /* Atur posisi di layar HP agar tidak menutupi konten penting */
    @media (max-width: 576px) {
        #floating-wa {
            width: 50px;
            height: 50px;
            font-size: 28px;
            bottom: 20px;
            right: 20px;
        }

        .wa-circle {
            width: 50px;
            height: 50px;
            font-size: 25px;
        }
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50%;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .navbar-brand img {
        height: 50px;
        width: auto;
        transition: transform 0.3s ease;
        object-fit: contain;
    }

    .navbar-brand img:hover {
        transform: scale(1.05);
        /* Efek sedikit membesar saat diarahkan kursor */
    }

    /* Penyesuaian ukuran logo di layar HP */
    @media (max-width: 768px) {
        .navbar-brand img {
            height: 40px !important;
        }
    }

    .navbar-brand {
        padding: 0;
        /* Menghilangkan padding bawaan bootstrap pada brand */
        display: flex;
        align-items: center;
    }

    /* .navbar-brand img {
        max-height: 85px;
        display: block;
    } */

    .navbar-brand img {
        height: 80px !important;
        /* Paksa ukuran agar lebih dominan seperti Putra Cabe */
        width: auto;
        object-fit: contain;
    }

    #modalWA .modal-content {
        border: none;
        border-radius: 20px;
        /* Membuat sudut membulat lebih halus */
        background: rgba(255, 255, 255, 0.95);
        /* Sedikit transparan */
        backdrop-filter: blur(10px);
        /* Efek blur di belakang modal */
    }

    /* 2. Nama Produk di Dalam Modal */
    #namaProdukModal {
        color: #0d6efd;
        /* Warna biru sesuai tema produk Anda */
        font-size: 0.95rem;
    }

    /* 5. Icon WhatsApp */
    #modalWA .fab.fa-whatsapp {
        font-size: 1.4rem;
    }

    /* 6. Animasi Modal Muncul */
    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: transform 0.3s ease-in-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    /* Efek Hover & Transisi Menu Samping */
    .list-group-item {
        transition: all 0.3s ease;
    }

    .list-group-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
        /* Biru sangat muda */
        padding-left: 30px !important;
        /* Efek geser sedikit ke kanan */
        color: #0d6efd !important;
    }

    .offcanvas {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        /* Animasi slide lebih smooth */
    }

    .testimoni-gallery {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        /* Maksimal 4 kolom */
        gap: 8px;
    }

    .gallery-item {
        position: relative;
        display: block;
        overflow: hidden;
        border-radius: 8px;
    }

    /* Efek +X Foto Lainnya */
    .more-photos::after {
        content: attr(data-count);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Gelapkan foto terakhir */
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
        /* Efek zoom saat hover */
    }

    .fancybox__nav {
        --f-button-color: #fff;
    }
    </style>
</head>

<body>