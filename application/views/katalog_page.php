<div class="container mt-n5" style="margin-top: -30px; position: relative; z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-wrapper">
                <div class="card shadow-lg border-0 rounded-pill p-1">
                    <form action="<?= base_url('home'); ?>" method="GET" class="input-group">
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
                    <div id="suggestion-results" class="d-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="container mt-5 mb-4 px-0">
        <div
            class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary d-none d-md-block"
                    style="width: 5px; height: 30px; border-radius: 10px; margin-right: 15px;"></div>
                <h3 class="fw-bold mb-0 fs-4 fs-md-3"><?= $judul_halaman; ?></h3>
            </div>
            <div class="w-100-mobile">
                <a href="<?= base_url(); ?>" class="btn btn-back-home shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
        <hr class="mt-3 opacity-10">
    </div>

    <div class="container mt-4 px-0">
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="d-flex gap-2 w-100 w-md-auto mb-2 mb-md-0">
                    <div class="input-group shadow-sm border rounded flex-nowrap flex-grow-1 flex-md-grow-0">
                        <span class="input-group-text bg-white border-0 px-2"><i
                                class="fas fa-filter text-primary"></i></span>
                        <select class="form-select border-0 ps-0 select-custom"
                            onchange="updateFilter('kategori', this.value)">
                            <option value="">Semua Kategori</option>
                            <?php foreach($semua_kategori as $kat): 
                                $clean_name = str_replace(['(', ')', '&'], ['', '', ''], $kat['nama_kategori']);
                                $slug_kat = url_title($clean_name, 'dash', TRUE);
                            ?>
                            <option value="<?= $slug_kat; ?>"
                                <?= ($this->input->get('kategori') == $slug_kat) ? 'selected' : ''; ?>>
                                <?= $kat['nama_kategori']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group shadow-sm border rounded flex-nowrap flex-grow-1 flex-md-grow-0">
                        <span class="input-group-text bg-white border-0 px-2"><i
                                class="fas fa-sort-amount-down text-primary"></i></span>
                        <select class="form-select border-0 ps-0 select-custom"
                            onchange="updateFilter('sort', this.value)">
                            <option value="DESC" <?= ($this->input->get('sort') == 'DESC') ? 'selected' : ''; ?>>Terbaru
                            </option>
                            <option value="ASC" <?= ($this->input->get('sort') == 'ASC') ? 'selected' : ''; ?>>Terlama
                            </option>
                            <option value="MV" <?= ($this->input->get('sort') == 'MV') ? 'selected' : ''; ?>>Terpopuler
                            </option>
                            <option value="LV" <?= ($this->input->get('sort') == 'LV') ? 'selected' : ''; ?>>Kurang
                                Populer</option>
                            <option value="AZ" <?= ($this->input->get('sort') == 'AZ') ? 'selected' : ''; ?>>Nama A-Z
                            </option>
                            <option value="ZA" <?= ($this->input->get('sort') == 'ZA') ? 'selected' : ''; ?>>Nama Z-A
                            </option>
                        </select>
                    </div>
                </div>

                <?php if ($this->input->get('kategori') || $this->input->get('search')): ?>
                <div class="w-100 w-md-auto text-start text-md-end mt-1 mt-md-0">
                    <div class="text-muted small bg-light px-3 py-1 rounded-pill border d-inline-block">
                        <i class="fas fa-info-circle me-1"></i> Menampilkan <strong><?= count($produk); ?></strong>
                        produk
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="main-content-wrapper">
        <?php if (empty($produk)) : ?>
        <div class="row">
            <div class="col-12 text-center py-5">
                <div class="empty-state-animation mb-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-box fa-stack-1x text-light"></i>
                        <i class="fas fa-search fa-stack-2x text-primary opacity-25"></i>
                    </span>
                </div>
                <h3 class="fw-bold text-dark">Ups! Produk Tidak Ditemukan</h3>
                <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">
                    Maaf, saat ini kami belum memiliki koleksi produk untuk kategori
                    <strong>"<?= isset($kategori_aktif) ? $kategori_aktif : 'yang Anda cari'; ?>"</strong>.
                </p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="<?= base_url('katalog'); ?>" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-th-large me-2"></i> Lihat Semua Produk
                    </a>
                    <button class="btn btn-outline-success rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#modalWA">
                        <i class="fab fa-whatsapp me-2"></i> Tanya Admin
                    </button>
                </div>
            </div>
        </div>

        <?php if (!empty($rekomendasi)) : ?>
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12 text-center mb-4">
                <h4 class="fw-bold">Mungkin Anda Mencari Ini?</h4>
                <div class="mx-auto bg-primary" style="width: 50px; height: 3px; border-radius: 10px;"></div>
            </div>
            <?php foreach($rekomendasi as $r) : ?>
            <div class="col-6 col-md-3 mb-4 px-2 d-flex">
                <div class="product-card w-100"> <img src="<?= base_url('assets/img/produk/' . $r['foto_barang']); ?>"
                        class="product-img" alt="<?= $r['nama_barang']; ?>">
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="product-title-wrapper mb-3" style="min-height: 2.8rem;">
                            <h6 class="fw-bold mb-0 text-dark"><?= $r['nama_barang']; ?></h6>
                        </div>

                        <a href="<?= base_url('detail/' . url_title($r['nama_barang'], 'dash', TRUE) . '/' . $r['id_produk']); ?>"
                            class="btn btn-outline-primary btn-sm w-100 mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php else : ?>
        <div class="row g-3 g-md-4" id="product-container">
            <?php foreach($produk as $p) : ?>
            <?php 
                    $no_wa = "6282136405274"; 
                    $pesan = "Halo Admin CV. ABADI JAYA MITRA, saya tertarik dengan produk *" . $p['nama_barang'] . "*. Bisa minta info lebih lanjut?";
                    $link_wa = "https://wa.me/" . $no_wa . "?text=" . urlencode($pesan);
                    $slug = url_title($p['nama_barang'], 'dash', TRUE); 
                    $link_detail = base_url('detail/' . $slug . '/' . $p['id_produk']);
                ?>
            <div class="col-6 col-md-3 mb-3 px-2">
                <div class="product-card">
                    <div class="position-relative">
                        <a href="<?= $link_detail; ?>">
                            <span class="view-badge-mobile">
                                <i class="far fa-eye"></i> <?= number_format($p['views'], 0, ',', '.'); ?>
                            </span>
                            <img src="<?= base_url('assets/img/produk/' . $p['foto_barang']); ?>" class="product-img"
                                alt="<?= $p['nama_barang']; ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-1">
                            <span class="category-badge"><?= $p['nama_kategori']; ?></span>
                        </div>

                        <div class="product-title-wrapper">
                            <a href="<?= $link_detail; ?>" class="text-decoration-none text-dark">
                                <h5 class="product-title"><?= $p['nama_barang']; ?></h5>
                            </a>
                        </div>

                        <a href="<?= $link_wa; ?>" target="_blank" class="btn btn-whatsapp w-100 py-2">
                            <i class="fab fa-whatsapp me-2"></i> Tanya Harga
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5 mb-5">
            <button id="load-more-btn" class="btn btn-load-more shadow-sm px-5">Muat Produk Lebih Banyak</button>
            <p id="no-more-msg" class="text-muted d-none mt-3">Semua produk telah ditampilkan.</p>
        </div>
        <?php endif; ?>
    </div>
</div>