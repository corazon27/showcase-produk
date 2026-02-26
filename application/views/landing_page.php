<div class="container mt-n5" style="margin-top: -30px; position: relative; z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-wrapper">
                <div class="card shadow-lg border-0 rounded-pill p-1">
                    <form action="<?= base_url(''); ?>" method="GET" class="input-group">
                        <input type="text" id="main-search" name="search"
                            class="form-control border-0 rounded-pill-start ps-4" placeholder="Cari produk pengadaan..."
                            autocomplete="off">
                        <button class="btn btn-primary rounded-pill-end px-4" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div id="hot-keywords-panel" class="hot-keywords-dropdown shadow-sm">
                    <div id="default-hotkeys" class="p-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-fire text-danger me-2 small"></i>
                            <span class="fw-bold small text-muted">PENCARIAN POPULER</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach($hot_keywords as $hk) : ?>
                            <a href="<?= base_url('home?search='.urlencode($hk['keyword'])); ?>" class="btn-keyword">
                                <?= strtoupper($hk['keyword']); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="suggestion-results" class="d-none">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="container mt-5 mb-4">
        <div
            class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary d-none d-md-block"
                    style="width: 5px; height: 30px; border-radius: 10px; margin-right: 15px;"></div>
                <h3 class="fw-bold mb-0 fs-4 fs-md-3"><?= $judul_halaman; ?></h3>
            </div>

            <div class="w-100-mobile">
                <?php if(isset($is_best_seller) && $is_best_seller == true): ?>
                <a href="<?= base_url('katalog'); ?>" class="btn btn-back-home rounded-pill px-4 shadow-sm">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
                <?php elseif($this->input->get('kategori') || $this->input->get('search')): ?>
                <a href="<?= base_url('katalog'); ?>" class="btn btn-back-home rounded-pill px-4 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Lihat Semua Produk
                </a>
                <?php endif; ?>
            </div>
        </div>
        <hr class="mt-3 opacity-10">
    </div>

    <div class="row g-3 g-md-4">
        <?php if (empty($produk)) : ?>
        <div class="col-12 text-center py-5">
            <img src="<?= base_url('assets/img/no-product.png'); ?>" style="width: 150px; opacity: 0.5;">
            <h4 class="mt-3 text-muted">Ups! Produk tidak ditemukan</h4>
            <p>Coba cari kata kunci lain atau kembali ke katalog utama.</p>
            <a href="<?= base_url(); ?>" class="btn btn-primary rounded-pill px-4">Kembali ke Beranda</a>
        </div>
        <?php else : ?>
        <?php foreach($produk as $p) : ?>
        <?php 
                    $slug = url_title($p['nama_barang'], 'dash', TRUE); 
                    $link_detail = base_url('detail/' . $slug . '/' . $p['id_produk']);
                    $pesan = "Halo Admin CV. ABADI JAYA MITRA, saya tertarik dengan produk ini: \n\n" . $p['nama_barang'] . "\n" . $link_detail;
                ?>
        <div class="col-6 col-md-3 mb-3 px-2">
            <div class="product-card">
                <div class="position-relative">
                    <a href="<?= $link_detail; ?>">
                        <img src="<?= base_url('assets/img/produk/' . $p['foto_barang']); ?>" class="product-img"
                            alt="<?= $p['nama_barang']; ?>">
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="mb-1">
                        <span class="category-badge"><?= $p['nama_kategori']; ?></span>
                    </div>
                    <a href="<?= $link_detail; ?>" class="text-decoration-none text-dark">
                        <h5 class="fw-bold mb-3" style="font-size: 1rem;"><?= $p['nama_barang']; ?></h5>
                    </a>
                    <button type="button" class="btn btn-whatsapp w-100 py-2 btn-tanya-harga" data-bs-toggle="modal"
                        data-bs-target="#modalWA" data-produk="<?= $p['nama_barang']; ?>"
                        data-pesan="<?= urlencode($pesan); ?>">
                        <i class="fab fa-whatsapp me-2"></i> Tanya Harga
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
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