<section class="py-5 bg-white">
    <div class="container">
        <div class="card border-0 shadow-sm p-4 rounded-4">
            <h4 class="fw-bold mb-4">Bagikan Pengalaman Anda</h4>
            <form action="<?= base_url('testimoni/kirim'); ?>" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="fw-bold mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control rounded-pill"
                            placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold mb-1">Instansi/Perusahaan</label>
                        <input type="text" name="instansi" class="form-control rounded-pill" placeholder="Nama instansi"
                            required>
                    </div>
                    <div class="col-12">
                        <label class="fw-bold mb-1">Pesan Testimoni</label>
                        <textarea name="isi" class="form-control rounded-4" rows="4"
                            placeholder="Tuliskan pengalaman Anda menggunakan layanan kami..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Foto Testimoni (Bisa pilih lebih dari satu)</label>
                        <div class="input-group">
                            <input type="file" name="foto_testimoni[]" id="image-upload" class="form-control"
                                accept="image/*" multiple>
                        </div>
                        <small class="text-muted">Pilih satu atau beberapa foto saat barang sampai atau sedang
                            digunakan.</small>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold mb-1">Kategori Layanan</label>
                        <select name="id_kategori" class="form-select rounded-pill" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="image-preview-container" class="d-flex flex-wrap gap-2 mt-3">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 mt-2">
                            Kirim Testimoni <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row align-items-end mb-5">
        <div class="col-md-8">
            <h2 class="fw-bold">Kepercayaan Pelanggan</h2>
            <p class="text-muted mb-0">Apa kata mereka tentang layanan kami</p>
        </div>

        <div class="col-md-4 mt-3 mt-md-0">
            <form action="" method="GET" id="filterForm">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                        <i class="fas fa-filter text-primary"></i>
                    </span>
                    <select name="kategori" class="form-select border-start-0 rounded-end-pill"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Kategori</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k['id_kategori']; ?>"
                            <?= ($this->input->get('kategori') == $k['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $k['nama_kategori']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach($testimoni as $t) : ?>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="mb-3">
                    <i class="fas fa-quote-left text-primary opacity-25 fs-1"></i>
                </div>

                <div class="mb-4">
                    <p class="text-dark fw-medium" style="line-height: 1.6;">"<?= $t['isi_testimoni']; ?>"</p>
                </div>

                <div class="testimoni-gallery mb-4">
                    <?php 
    $fotos = $this->db->get_where('testimoni_foto', ['id_testi' => $t['id_testi']])->result_array();
    $total_foto = count($fotos);
    $max_display = 4; // Jumlah maksimal foto yang tampil langsung
    
    foreach(array_slice($fotos, 0, $max_display) as $index => $f) : 
        // Cek apakah ini foto terakhir yang ditampilkan dan masih ada sisa foto
        $is_last = ($index === $max_display - 1 && $total_foto > $max_display);
    ?>
                    <a href="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                        data-fancybox="gallery-<?= $t['id_testi']; ?>"
                        class="gallery-item <?= $is_last ? 'more-photos' : ''; ?>"
                        data-count="+<?= $total_foto - $max_display; ?>">
                        <img src="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                            class="rounded shadow-sm border" style="width: 100%; height: 70px; object-fit: cover;">
                    </a>
                    <?php endforeach; ?>

                    <?php if($total_foto > $max_display) : 
        foreach(array_slice($fotos, $max_display) as $f) : ?>
                    <a href="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                        data-fancybox="gallery-<?= $t['id_testi']; ?>" class="d-none"></a>
                    <?php endforeach; endif; ?>
                </div>

                <div class="d-flex align-items-center mt-auto pt-3 border-top">
                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 48px; height: 48px;">
                        <i class="fas fa-user-tie fs-5"></i>
                    </div>

                    <div class="overflow-hidden">
                        <h6 class="fw-bold mb-1 text-dark text-truncate" title="<?= $t['nama_pelanggan']; ?>">
                            <?= $t['nama_pelanggan']; ?>
                        </h6>
                        <p class="small text-muted mb-0 text-truncate">
                            <i class="fas fa-building me-1 text-primary opacity-75"></i>
                            <?= $t['instansi']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if($total_testi > 6) : ?>
    <div class="text-center mt-5">
        <button id="load-more" class="btn btn-outline-primary rounded-pill px-5">Muat Lebih Banyak</button>
    </div>
    <?php endif; ?>
</div>