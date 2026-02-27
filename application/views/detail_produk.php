<nav class="navbar navbar-light bg-white sticky-top py-3 shadow-sm">
    <div class="container d-flex align-items-center">
        <a href="<?= base_url(); ?>" class="text-dark me-3">
            <i class="fas fa-arrow-left fa-lg"></i>
        </a>

        <form action="<?= base_url(''); ?>" method="GET" class="flex-grow-1 mx-2 mx-lg-5 position-relative">
            <div class="search-wrapper">
                <div class="position-relative">
                    <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="main-search" name="search"
                        class="form-control bg-light border-0 rounded-pill ps-5" style="height: 45px;"
                        placeholder="Search anything..." autocomplete="off">
                </div>

                <div id="hot-keywords-panel" class="hot-keywords-dropdown shadow-sm">
                    <div id="default-hotkeys" class="p-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-fire text-danger me-2 small"></i>
                            <span class="fw-bold small text-muted" style="font-size: 10px;">PENCARIAN POPULER</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <?php if(!empty($hot_keywords)): foreach($hot_keywords as $hk) : ?>
                            <a href="<?= base_url('home?search='.urlencode($hk['keyword'])); ?>" class="btn-keyword">
                                <?= strtoupper($hk['keyword']); ?>
                            </a>
                            <?php endforeach; else: ?>
                            <span class="text-muted small ps-1">Tidak ada keyword populer</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div id="suggestion-results"></div>
                </div>
            </div>
        </form>

        <div class="ms-2">
            <button class="btn border-0 p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 7.5H25M5 15H25M5 22.5H25" stroke="#495057" stroke-width="2.5" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="row g-5">
        <div class="col-lg-6 col-12">
            <div class="swiper mySwiper rounded-4 shadow-sm">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="<?= base_url('assets/img/produk/' . $produk['foto_barang']); ?>"
                            data-fancybox="gallery-produk" data-caption="Foto Utama: <?= $produk['nama_barang']; ?>">
                            <img src="<?= base_url('assets/img/produk/' . $produk['foto_barang']); ?>"
                                class="product-img-swiper" style="cursor: zoom-in;">
                        </a>
                    </div>

                    <?php foreach($galeri as $g) : ?>
                    <div class="swiper-slide">
                        <a href="<?= base_url('assets/img/produk/' . $g['foto_tambahan']); ?>"
                            data-fancybox="gallery-produk" data-caption="Galeri Foto <?= $produk['nama_barang']; ?>">
                            <img src="<?= base_url('assets/img/produk/' . $g['foto_tambahan']); ?>"
                                class="product-img-swiper" style="cursor: zoom-in;">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="swiper-pagination-custom d-flex justify-content-center mt-3"></div>
        </div>

        <div class="col-lg-6 col-12">
            <nav aria-label="breadcrumb overflow-x: auto; white-space: nowrap;" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"
                            class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page">
                        <?php 
                        // Bersihkan nama dari simbol yang mengganggu URL
                        $clean_name = str_replace(['(', ')', '&'], ['', '', ''], $produk['nama_kategori']);
                        // Ganti spasi ganda menjadi tunggal jika ada
                        $clean_name = str_replace('  ', ' ', $clean_name);
                        ?>
                        <a href="<?= base_url('katalog?kategori=' . url_title($clean_name, 'dash', TRUE)); ?>"
                            class=" text-decoration-none">
                            <?= $produk['nama_kategori']; ?>
                        </a>
                    </li>
                </ol>
            </nav>

            <h1 class="display-6 fw-bold mb-2"><?= $produk['nama_barang']; ?></h1>
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="text-warning small">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <span class="text-muted small">|</span>
                <span class="text-muted small"><i class="far fa-eye me-1"></i>
                    <?= number_format($produk['views'], 0, ',', '.'); ?> views</span>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="spec-label">Kategori</td>
                        <td class="spec-value">: <?= $produk['nama_kategori']; ?></td>
                    </tr>
                    <tr>
                        <td class="spec-label">Lokasi Unit</td>
                        <td class="spec-value">: Kantor Pusat (Ready)</td>
                    </tr>
                    <tr>
                        <td class="spec-label">Status</td>
                        <td class="spec-value">: <span class="badge bg-success">Tersedia</span></td>
                    </tr>
                    <tr>
                        <td class="spec-label">Bagikan</td>
                        <td class="spec-value">:
                            <button class="btn btn-sm btn-share-custom rounded-pill px-3 text-white"
                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i class="fas fa-share-alt me-1"></i> Sebar Produk
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs-new" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-new active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab">
                                    Deskripsi
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-new" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                    type="button" role="tab">
                                    Informasi Tambahan
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content py-4" id="productTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                                <div class="text-muted">
                                    <?= $produk['deskripsi_singkat']; ?>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="info" role="tabpanel">
                                <h5 class="fw-bold mb-3">Spesifikasi Detail</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-spec-custom">
                                        <tbody>
                                            <tr>
                                                <td class="label-column">Warna</td>
                                                <td class="value-column">
                                                    Merah
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-column">Kategori</td>
                                                <td class="value-column"><?= $produk['nama_kategori']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column">Status Stok</td>
                                                <td class="value-column">
                                                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                $no_wa = "6282136405274"; 
                $pesan = "Halo Admin CV. Abadi Jaya Mitra, saya tertarik dengan *" . $produk['nama_barang'] . "* yang ada di website.";
                $link_wa = "https://wa.me/" . $no_wa . "?text=" . urlencode($pesan);
            ?>
            <button type="button" class="btn btn-whatsapp-detail w-100 shadow btn-tanya-harga" data-bs-toggle="modal"
                data-bs-target="#modalWA" data-produk="<?= $produk['nama_barang']; ?>"
                data-pesan="<?= urlencode($pesan); ?>">
                <i class="fab fa-whatsapp me-2"></i> Tanya Harga via WhatsApp
            </button>
        </div>
    </div>
</div>


<div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Sebar Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="d-flex justify-content-around mb-4">
                    <a href="https://wa.me/?text=Cek produk ini: <?= current_url(); ?>" target="_blank"
                        class="text-decoration-none text-dark">
                        <div class="share-icon bg-success bg-opacity-10 text-success rounded-circle mb-2">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </div>
                        <small>WhatsApp</small>
                    </a>
                    <a href="https://t.me/share/url?url=<?= current_url(); ?>&text=Cek produk ini" target="_blank"
                        class="text-decoration-none text-dark">
                        <div class="share-icon bg-info bg-opacity-10 text-info rounded-circle mb-2">
                            <i class="fab fa-telegram-plane fa-lg"></i>
                        </div>
                        <small>Telegram</small>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url(); ?>" target="_blank"
                        class="text-decoration-none text-dark">
                        <div class="share-icon bg-primary bg-opacity-10 text-primary rounded-circle mb-2">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </div>
                        <small>Facebook</small>
                    </a>
                </div>

                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-light border-0" value="<?= current_url(); ?>"
                        id="urlProduk" readonly>
                    <button class="btn btn-primary px-3" onclick="copyLink()">
                        <i class="far fa-copy"></i> Salin
                    </button>
                </div>
                <div id="copyNotice" class="text-success small d-none animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle"></i> Link berhasil disalin ke clipboard!
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($terkait)): ?>
<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="fw-bold section-header-title mb-0">Produk Terkait</h4>
        <?php 
                        // Bersihkan nama dari simbol yang mengganggu URL
                        $clean_name = str_replace(['(', ')', '&'], ['', '', ''], $produk['nama_kategori']);
                        // Ganti spasi ganda menjadi tunggal jika ada
                        $clean_name = str_replace('  ', ' ', $clean_name);
                        ?>
        <a href="<?= base_url('katalog?kategori=' . url_title($clean_name, 'dash', TRUE)); ?>"
            class="btn-nav-more rounded-pill shadow-sm text-white">
            Lihat <?= $produk['nama_kategori']; ?> <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>

    <div class="row g-3">
        <?php foreach($terkait as $t): ?>
        <?php 
                    $no_wa = "6282136405274"; 
                    $slug = url_title($t['nama_barang'], 'dash', TRUE); 
                    $link_detail = base_url('detail/' . $slug . '/' . $t['id_produk']);
                ?>
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card-hover">
                <a href="<?= $link_detail; ?>" class="text-decoration-none text-dark">
                    <div class="img-wrapper-custom">
                        <img src="<?= base_url('assets/img/produk/' . $t['foto_barang']); ?>" class="card-img-top"
                            style="height: 160px; object-fit: cover;" loading="lazy">
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold text-truncate mb-0"><?= $t['nama_barang']; ?></h6>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="container mt-5 mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="fw-bold section-header-title mb-0">Mungkin Kamu Suka</h4>
        <a href="<?= base_url('katalog'); ?>" class="btn-nav-more rounded-pill shadow-sm text-white">
            Semua Katalog <i class="fas fa-store fa-th-large ms-2"></i>
        </a>
    </div>

    <div class="row g-3">
        <?php foreach($random_products as $r): ?>
        <?php 
                    $no_wa = "6282136405274"; 
                    $slug = url_title($r['nama_barang'], 'dash', TRUE); 
                    $link_detail = base_url('detail/' . $slug . '/' . $r['id_produk']);
                ?>
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card-hover">
                <a href="<?= $link_detail; ?>" class="text-decoration-none text-dark">
                    <div class="img-wrapper-custom">
                        <img src="<?= base_url('assets/img/produk/' . $r['foto_barang']); ?>" class="card-img-top"
                            style="height: 160px; object-fit: cover;" loading="lazy">
                    </div>
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase d-block mb-1"
                            style="font-size: 9px;"><?= $r['nama_kategori']; ?></small>
                        <h6 class="fw-bold text-truncate mb-0"><?= $r['nama_barang']; ?></h6>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="modalWA" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <h5 class="fw-bold mb-1">Pilih Admin Tujuan</h5>
                <p class="text-muted small mb-4">Silakan pilih admin untuk melanjutkan percakapan</p>
                <div class="text-center mb-4">
                    <p class="small text-muted mb-0">Produk: <span id="namaProdukModal"
                            class="fw-bold text-dark"></span></p>
                </div>

                <a href="#" id="linkAdmin1" target="_blank"
                    class="btn btn-whatsapp w-100 py-3 rounded-pill mb-3 d-flex align-items-center justify-content-center">
                    <i class="fab fa-whatsapp fa-lg me-2"></i> <strong>WhatsApp Admin 1</strong>
                </a>

                <a href="#" id="linkAdmin2" target="_blank"
                    class="btn btn-whatsapp w-100 py-3 rounded-pill d-flex align-items-center justify-content-center">
                    <i class="fab fa-whatsapp fa-lg me-2"></i> <strong>WhatsApp Admin 2</strong>
                </a>

            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel"
    style="width: 300px;">
    <div class="offcanvas-header border-bottom py-4 bg-light">
        <div class="d-flex align-items-center">
            <img src="<?= base_url('assets/img/logo_ajm.png'); ?>" alt="Logo" style="height: 40px;" class="me-2">
            <div>
                <h6 class="offcanvas-title fw-bold text-dark mb-0" id="offcanvasNavbarLabel" style="font-size: 0.9rem;">
                    CV. ABADI JAYA MITRA</h6>
                <small class="text-muted" style="font-size: 0.7rem;">Solusi Pengadaan Anda</small>
            </div>
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="<?= base_url(); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-home me-3 text-primary fs-5"></i> <span class="fw-semibold">Beranda</span>
            </a>
            <a href="<?= base_url('katalog'); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-store me-3 text-primary fs-5"></i> <span class="fw-semibold">Katalog Produk</span>
            </a>
            <a href="<?= base_url('tentang-kami'); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-info-circle me-3 text-primary fs-5"></i>
                <span class="fw-semibold">Tentang Kami</span>
            </a>
            <a href="<?= base_url('cara-order'); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-shopping-cart me-3 text-primary fs-5"></i>
                <span class="fw-semibold">Cara Order</span>
            </a>
            <a href="<?= base_url('kontak-kami'); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-address-book me-3 text-primary fs-5"></i>
                <span class="fw-semibold">Kontak Kami</span>
            </a>
            <a href="<?= base_url('testimoni'); ?>"
                class="list-group-item list-group-item-action border-0 py-3 px-4 d-flex align-items-center">
                <i class="fas fa-comments me-3 text-primary fs-5"></i>
                <span class="fw-semibold">Testimoni</span>
            </a>
        </div>

        <div class="p-4 mt-auto">
            <p class="small text-muted fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">Hubungi Kami:</p>
            <a href="https://wa.me/6282136405274" target="_blank"
                class="btn btn-success w-100 rounded-pill mb-3 py-2 shadow-sm d-flex align-items-center justify-content-center">
                <i class="fab fa-whatsapp me-2 fs-5"></i> Admin 1
            </a>
            <a href="https://wa.me/6281225876355" target="_blank"
                class="btn btn-outline-success w-100 rounded-pill py-2 d-flex align-items-center justify-content-center">
                <i class="fab fa-whatsapp me-2 fs-5"></i> Admin 2
            </a>
        </div>
    </div>
</div>