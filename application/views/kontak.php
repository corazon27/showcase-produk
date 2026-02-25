<section class="py-5 bg-light">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Hubungi <span class="text-primary">Kami</span></h2>
            <p class="text-muted">Punya pertanyaan mengenai pengadaan? Tim kami siap membantu Anda.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 h-100 rounded-4">
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>

                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-primary"><i class="fas fa-map-marker-alt fa-lg"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Alamat Kantor</h6>
                            <p class="small text-muted">Lokasi Kantor CV. ABADI JAYA MITRA</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-success"><i class="fab fa-whatsapp fa-lg"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">WhatsApp Admin</h6>
                            <p class="small text-muted">+62 821-3640-5274</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-danger"><i class="fas fa-envelope fa-lg"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Email Resmi</h6>
                            <p class="small text-muted">info@abadijayamitra.com</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="icon-box me-3 text-warning"><i class="fas fa-clock fa-lg"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Jam Kerja</h6>
                            <p class="small text-muted">Senin - Sabtu (08.00 - 17.00)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 h-100 rounded-4">
                    <h5 class="fw-bold mb-4">Kirim Pesan Cepat</h5>
                    <form id="wa-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold">Nama Lengkap</label>
                                <input type="text" id="name" class="form-control rounded-pill"
                                    placeholder="Masukkan nama Anda">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold">Instansi/Perusahaan</label>
                                <input type="text" id="instansi" class="form-control rounded-pill"
                                    placeholder="Nama instansi">
                            </div>

                            <div class="col-12">
                                <label class="small fw-bold">Subjek Pertanyaan</label>
                                <select id="subject" class="form-select rounded-pill">
                                    <option value="Tanya Harga Produk" selected>Tanya Harga Produk</option>
                                    <option value="Status Pengiriman">Status Pengiriman</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="small fw-bold">Pesan Anda</label>
                                <textarea id="message" class="form-control rounded-4" rows="4"
                                    placeholder="Tuliskan detail kebutuhan Anda..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="button" class="btn btn-primary rounded-pill px-5" data-bs-toggle="modal"
                                    data-bs-target="#modalLinktree">
                                    Kirim Sekarang <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalLinktree" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <h5 class="fw-bold mb-1">Pilih Admin Tujuan</h5>
                <p class="text-muted small mb-4">Silakan pilih admin untuk melanjutkan percakapan</p>

                <button onclick="kirimAdminWhatsApp('6282136405274')"
                    class="btn btn-whatsapp w-100 mb-3 py-3 rounded-pill d-flex align-items-center justify-content-center">
                    <i class="fab fa-whatsapp fa-2x me-3"></i>
                    <div class="text-start">
                        <div class="fw-bold">Admin 1 WhatsApp</div>
                        <small>Pengadaan ATK & Retail</small>
                    </div>
                </button>

                <button onclick="kirimAdminWhatsApp('6281225876355')"
                    class="btn btn-whatsapp w-100 py-3 rounded-pill d-flex align-items-center justify-content-center">
                    <i class="fab fa-whatsapp fa-2x me-3"></i>
                    <div class="text-start">
                        <div class="fw-bold">Admin 2 WhatsApp</div>
                        <small>Pengadaan ATK & Retail</small>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>