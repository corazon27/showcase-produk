<footer class="custom-footer text-white">
    <div class="container py-5">
        <div class="row g-4 lg-g-5">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="<?= base_url('assets/img/logo_ajm.png'); ?>" alt="Logo CV AJM" class="footer-logo mb-3">
                <p class="footer-desc">
                    CV. ABADI JAYA MITRA adalah mitra terpercaya dalam pengadaan Alat Tulis Kantor (ATK) dan perangkat
                    elektronik untuk instansi pemerintah maupun swasta.
                </p>
            </div>

            <div class="col-6 col-lg-2 offset-lg-1">
                <h5 class="footer-title">Navigasi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= base_url(); ?>">Beranda</a></li>
                    <li><a href="<?= base_url('tentang-kami'); ?>">Tentang Kami</a></li>
                    <li><a href="<?= base_url('cara-order'); ?>">Cara Order</a></li>
                    <li><a href="<?= base_url('kontak-kami'); ?>">Kontak</a></li>
                    <li><a href="<?= base_url('testimoni'); ?>">Testimoni</a></li>
                </ul>
            </div>

            <div class="col-lg-5">
                <h5 class="footer-title">Kontak Kami</h5>
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="contact-card">
                            <h6>Admin 1</h6>
                            <p>+62 821-3640-5274</p>
                            <a href="https://wa.me/6282136405274" class="btn-wa">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-card">
                            <h6>Admin 2</h6>
                            <p>+62 812-2587-6355</p>
                            <a href="https://wa.me/6281225876355" class="btn-wa">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <div class="location-box border-top pt-4">
                    <h5 class="footer-title">Lokasi Kami</h5>
                    <div class="d-flex align-items-start mb-3 text-secondary footer-desc">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-primary"></i>
                        <span>
                            <strong>Kantor Pusat:</strong><br>
                            Perum Bumi Nusantara 1, Magelang,<br> Jawa Tengah 56172
                        </span>
                    </div>
                    <a href="https://maps.google.com/?q=Perum+Bumi+Nusantara+1+Magelang" target="_blank"
                        class="btn-map">
                        <i class="fas fa-directions me-2"></i>Petunjuk Arah Ke Lokasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 border-top border-secondary border-opacity-25">
        <div class="container text-center text-md-between d-md-flex">
            <p class="mb-0 small text-secondary">&copy; 2026 CV. ABADI JAYA MITRA. All Rights Reserved.</p>
            <p class="mb-0 small text-secondary mt-2 mt-md-0">Penyedia ATK & Elektronik Terpercaya</p>
        </div>
    </div>
</footer>

<?php 
    // 1. Tentukan Nomor Admin
    $wa_admin = "6282136405274"; 

    // 2. Logika Pesan Dinamis
    // Kita cek apakah variabel $produk['nama_barang'] tersedia (hanya ada di halaman detail)
    if (isset($produk['nama_barang'])) {
        $pesan_wa = "Halo Admin CV. ABADI JAYA MITRA, saya sedang melihat *" . $produk['nama_barang'] . "* dan ingin bertanya lebih lanjut.";
    } else {
        // Pesan umum untuk Beranda, Tentang Kami, dll.
        $pesan_wa = "Halo Admin CV. Abadi Jaya Mitra, saya ingin bertanya mengenai layanan pengadaan barang.";
    }
    
    $text_wa = urlencode($pesan_wa);
?>

<a href="https://wa.me/<?= $wa_admin; ?>?text=<?= $text_wa; ?>" id="btn-wa-scroll" target="_blank" class="wa-circle"
    title="Tanya Admin">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if($this->uri->segment(1) == 'katalog'): ?>
<script>
$(document).ready(function() {
    // Menghitung jumlah awal produk untuk menentukan offset
    let jumlahAwal = $('#product-container').children().length;

    // Jika produk awal kurang dari 8, sembunyikan tombol load more
    if (jumlahAwal < 8) {
        $('#load-more-btn').hide();
    }

    let offset = jumlahAwal;

    $('#load-more-btn').click(function() {
        let btn = $(this);
        const urlParams = new URLSearchParams(window.location.search);
        const kategori = "<?= $id_kategori_aktif; ?>";
        const sort = urlParams.get('sort') || 'DESC';

        // Efek loading pada tombol
        btn.html('<span class="spinner-border spinner-border-sm"></span> Memuat...').prop('disabled',
            true);

        $.ajax({
            url: "<?= base_url('katalog/load_more'); ?>",
            type: "POST",
            data: {
                offset: offset,
                kategori: kategori,
                sort: sort
            },
            dataType: "JSON",
            success: function(data) {
                if (data.length > 0) {
                    let html = '';
                    $.each(data, function(index, p) {
                        // Logika slug & formatting yang sama dengan PHP
                        let slug = p.nama_barang.toLowerCase()
                            .replace(/[()&]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');

                        let views = new Intl.NumberFormat('id-ID').format(p.views);
                        let linkDetail =
                            `<?= base_url('detail/'); ?>${slug}/${p.id_produk}`;
                        let pesanWA = encodeURIComponent(
                            `Halo Admin CV. ABADI JAYA MITRA, saya tertarik dengan produk *${p.nama_barang}*. Bisa minta info lebih lanjut?`
                        );
                        let linkWA = `https://wa.me/6282136405274?text=${pesanWA}`;

                        // STRUKTUR HTML HARUS SAMA PERSIS DENGAN PHP
                        html += `
                            <div class="col-6 col-md-3 mb-3 px-2">
                                <div class="product-card">
                                    <div class="position-relative">
                                        <a href="${linkDetail}">
                                            <img src="<?= base_url('assets/img/produk/'); ?>${p.foto_barang}" class="product-img" alt="${p.nama_barang}">
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="mb-1">
                                            <span class="category-badge">${p.nama_kategori}</span>
                                        </div>
                                        <a href="${linkDetail}" class="text-decoration-none text-dark">
                                            <h5 class="fw-bold mb-3" style="font-size: 1rem;">${p.nama_barang}</h5>
                                        </a>
                                        <a href="${linkWA}" target="_blank" class="btn btn-whatsapp w-100 py-2">
                                            <i class="fab fa-whatsapp me-2"></i> Tanya Harga
                                        </a>
                                    </div>
                                </div>
                            </div>`;
                    });

                    let $newItems = $(html).hide();
                    $('#product-container').append($newItems);
                    $newItems.fadeIn(800);

                    offset += data.length;
                    btn.html('Muat Produk Lebih Banyak').prop('disabled', false);

                    // 4. CEK LIMIT 4: Jika data yang datang kurang dari 4, sembunyikan tombol
                    if (data.length < 4) {
                        btn.fadeOut();
                        $('#no-more-msg').removeClass('d-none');
                    }
                } else {
                    btn.fadeOut();
                    $('#no-more-msg').removeClass('d-none');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                btn.html('Gagal Memuat').prop('disabled', false);
            }
        });
    });
});
</script>
<?php endif; ?>

<script>
$(document).ready(function() {
    const searchInput = $('#main-search');
    const searchWrapper = $('.search-wrapper');

    // Munculkan saat input diklik atau fokus
    searchInput.on('focus', function() {
        searchWrapper.addClass('active');
    });

    // Tutup jika klik di luar area search-wrapper
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-wrapper').length) {
            searchWrapper.removeClass('active');
        }
    });

    // Opsional: Tutup saat tekan tombol ESC
    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            searchWrapper.removeClass('active');
            searchInput.blur();
        }
    });
});
</script>

<script>
$(document).ready(function() {
    const searchInput = $('#main-search');
    const hotkeysPanel = $('#default-hotkeys');
    const suggestionPanel = $('#suggestion-results');

    searchInput.on('input', function() {
        let val = $(this).val().trim(); // Gunakan trim() untuk hapus spasi kosong

        if (val.length > 0) {
            hotkeysPanel.addClass('d-none');
            suggestionPanel.removeClass('d-none');

            $.ajax({
                url: "<?= base_url('home/get_autosuggest'); ?>",
                type: "POST",
                data: {
                    keyword: val
                }, // Pastikan key 'keyword' sama dengan di Controller
                success: function(data) {
                    suggestionPanel.html(data);
                },
                error: function() {
                    console.log("Error mengambil data suggest");
                }
            });
        } else {
            // Jika input kosong, balikkan ke Hot Keywords dan bersihkan panel suggest
            hotkeysPanel.removeClass('d-none');
            suggestionPanel.addClass('d-none').html('');
        }
    });
});
</script>

<script>
function copyLink() {
    var copyText = document.getElementById("urlProduk");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile
    navigator.clipboard.writeText(copyText.value);

    // Tampilkan notifikasi
    var notice = document.getElementById("copyNotice");
    notice.classList.remove("d-none");

    // Sembunyikan kembali setelah 3 detik
    setTimeout(function() {
        notice.classList.add("d-none");
    }, 3000);
}
</script>


<script>
var swiper = new Swiper(".mySwiper", {
    loop: true, // Aktifkan agar tidak "buntu"
    spaceBetween: 3.5, // Garis pemisah
    centeredSlides: true,
    speed: 600,
    grabCursor: true,

    // Tambahkan ini agar sinkronisasi loop lebih akurat
    loopedSlides: 5,
    watchSlidesProgress: true,

    pagination: {
        el: ".swiper-pagination-custom",
        clickable: true,
        // Penting: Swiper akan otomatis mengelola jumlah dot 
        // sesuai jumlah slide asli (bukan slide duplikat loop)
    },

    // Opsional: aktifkan autoplay jika ingin seperti Barokah Motor
    autoplay: {
        delay: 8000,
        disableOnInteraction: false,
    },
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    const searchInput = $('#main-search');
    const panel = $('#hot-keywords-panel');
    const hotkeysArea = $('#default-hotkeys');
    const suggestArea = $('#suggestion-results');

    // Munculkan panel saat fokus
    searchInput.on('focus', function() {
        panel.addClass('show');
    });

    // Sembunyikan saat klik di luar
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-wrapper').length) {
            panel.removeClass('show');
        }
    });

    // Logika Pencarian
    searchInput.on('input', function() {
        let val = $(this).val().trim();

        if (val.length > 0) {
            // Sembunyikan Hot Keywords, tampilkan hasil suggest
            hotkeysArea.hide();
            suggestArea.show();

            $.ajax({
                url: "<?= base_url('home/get_autosuggest'); ?>",
                type: "POST",
                data: {
                    keyword: val
                }, // Pastikan ini 'search' sesuai name input kamu
                success: function(data) {
                    suggestArea.html(data);
                }
            });
        } else {
            // Jika kosong, balikkan ke Hot Keywords
            suggestArea.hide().html('');
            hotkeysArea.show();
        }
    });
});
</script>

<script>
function updateFilter(param, value) {
    const url = new URL(window.location.href);
    if (value) {
        url.searchParams.set(param, value);
    } else {
        url.searchParams.delete(param); // Jika pilih "Semua Kategori", hapus param kategori
    }
    window.location.href = url.href;
}
</script>


<script>
// Fungsi untuk memunculkan tombol saat scroll
window.onscroll = function() {
    var btnWa = document.getElementById("btn-wa-scroll");
    // Munculkan tombol jika user scroll lebih dari 300px dari atas
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        btnWa.style.display = "flex";
    } else {
        btnWa.style.display = "none";
    }
};
</script>

<script>
function kirimAdminWhatsApp(nomorAdmin) {
    // Ambil data dari form utama
    const name = document.getElementById('name').value;
    const instansi = document.getElementById('instansi').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;

    // Validasi singkat
    if (!name || !instansi || !message) {
        alert("Mohon isi formulir terlebih dahulu sebelum memilih admin!");
        // Tutup modal secara manual agar user bisa isi form
        var myModalEl = document.getElementById('modalLinktree');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
        return;
    }

    // Susun Pesan
    const text = `Halo Admin CV. ABADI JAYA MITRA,%0A%0A` +
        `Saya *${name}* dari *${instansi}*%0A` +
        `Subjek: *${subject}*%0A` +
        `*Pesan:* ${message}`;

    const url = `https://wa.me/${nomorAdmin}?text=${text}`;
    window.open(url, '_blank');
}
</script>

<script>
$(document).ready(function() {
    let offset = 6;
    const limit = 6;

    // AMBIL DATA TOTAL DARI PHP (Tambahkan variabel ini)
    const totalDataAwal = <?= $total_testi; ?>;

    // Logika awal: Cek apakah tombol harus muncul atau tidak berdasarkan data asli DB
    if (totalDataAwal <= limit) {
        $('#load-more-container').hide();
    } else {
        $('#load-more-container').show();
    }

    // FUNGSI UNTUK MERENDER KARTU (Satu pintu biar seragam)
    function renderCard(t) {
        // Logika Galeri Foto
        let photoHtml = '';
        const maxDisplay = 4;
        const totalFoto = t.fotos.length;

        if (totalFoto > 0) {
            t.fotos.slice(0, maxDisplay).forEach((f, index) => {
                const isLast = (index === maxDisplay - 1 && totalFoto > maxDisplay);
                const countAttr = isLast ? `data-count="+${totalFoto - maxDisplay}"` : '';
                const moreClass = isLast ? 'more-photos' : '';

                photoHtml += `
                    <a href="<?= base_url('assets/img/testi/'); ?>${f.nama_foto}" 
                       data-fancybox="gallery-${t.id_testi}" 
                       class="gallery-item ${moreClass}" ${countAttr}>
                        <img src="<?= base_url('assets/img/testi/'); ?>${f.nama_foto}" class="rounded border" style="width: 100%; height: 70px; object-fit: cover;">
                    </a>`;
            });
            // Foto tersembunyi untuk Fancybox
            if (totalFoto > maxDisplay) {
                t.fotos.slice(maxDisplay).forEach(f => {
                    photoHtml +=
                        `<a href="<?= base_url('assets/img/testi/'); ?>${f.nama_foto}" data-fancybox="gallery-${t.id_testi}" class="d-none"></a>`;
                });
            }
        }

        return `
            <div class="col-md-4 mb-4 item-testi">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px;">
                    <div class="mb-3"><i class="fas fa-quote-left text-primary opacity-25 fs-1"></i></div>
                    <div class="mb-4"><p class="text-dark fw-medium">"${t.isi_testimoni}"</p></div>
                    <div class="testimoni-gallery mb-4 d-flex gap-2">${photoHtml}</div>
                    <div class="d-flex align-items-center mt-auto pt-3 border-top">
                        <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">${t.nama_pelanggan}</h6>
                            <p class="small text-muted mb-0">${t.instansi}</p>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    // 1. FILTER KATEGORI
    $('#filterKategori').on('change', function() {
        const id_kat = $(this).val();
        const nama_kat = $("#filterKategori option:selected").text();
        offset = 0;

        $.ajax({
            url: "<?= base_url('testimoni/load_more'); ?>",
            type: "POST",
            data: {
                offset: offset,
                kategori: id_kat
            },
            success: function(data) {
                $('#testimony-container').empty();
                if (data.length > 0) {
                    data.forEach(t => $('#testimony-container').append(renderCard(t)));
                    offset = limit;
                    (data.length < limit) ? $('#load-more-container').hide(): $(
                        '#load-more-container').show();
                } else {
                    // TAMPILKAN EMPTY STATE JIKA KOSONG
                    $('#testimony-container').html(`
                        <div class="col-12 text-center py-5 my-5">
                            <div class="mb-4">
                                <i class="fas fa-search text-light" style="font-size: 100px; color: #e9ecef !important;"></i>
                            </div>
                            <h2 class="fw-bold">Ups! Testimoni Tidak Ditemukan</h2>
                            <p class="text-muted">
                                Maaf, saat ini kami belum memiliki koleksi testimoni untuk kategori 
                                <span class="fw-bold text-dark">"${nama_kat}"</span>.
                            </p>
                            <div class="mt-4">
                                <a href="<?= base_url('testimoni'); ?>" class="btn btn-primary px-4 rounded-pill">
                                    <i class="fas fa-sync-alt me-2"></i> Lihat Semua Testimoni
                                </a>
                            </div>
                        </div>
                    `);
                    $('#load-more-container').hide();
                }
            }
        });
    });

    // 2. LOAD MORE TOMBOL
    $('#load-more').on('click', function() {
        const id_kat = $('#filterKategori').val();
        $(this).prop('disabled', true).text('Loading...');

        $.ajax({
            url: "<?= base_url('testimoni/load_more'); ?>",
            type: "POST",
            data: {
                offset: offset,
                kategori: id_kat
            },
            success: function(data) {
                if (data.length > 0) {
                    data.forEach(t => $('#testimony-container').append(renderCard(t)));
                    offset += limit;
                    $('#load-more').prop('disabled', false).text('Muat Lebih Banyak');
                    if (data.length < limit) $('#load-more-container').hide();
                } else {
                    $('#load-more-container').hide();
                }
            }
        });
    });
});
</script>

<script>
$(document).on("click", ".btn-tanya-harga", function() {
    var namaProduk = $(this).data('produk');
    var pesanEncoded = $(this).data('pesan');

    // Nomer WA dari footer Anda
    var waAdmin1 = "6282136405274";
    var waAdmin2 = "6281225876355";

    // Update teks nama produk di modal
    $("#namaProdukModal").text(namaProduk);

    // Update Link href untuk kedua admin
    $("#linkAdmin1").attr("href", "https://wa.me/" + waAdmin1 + "?text=" + pesanEncoded);
    $("#linkAdmin2").attr("href", "https://wa.me/" + waAdmin2 + "?text=" + pesanEncoded);
});
</script>

<script>
let selectedFiles = []; // Array untuk menyimpan file yang dipilih

document.getElementById('image-upload').addEventListener('change', function() {
    const container = document.getElementById('image-preview-container');
    const files = Array.from(this.files);

    // Tambahkan file baru ke array global
    selectedFiles = selectedFiles.concat(files);
    renderPreviews();
});

function renderPreviews() {
    const container = document.getElementById('image-preview-container');
    container.innerHTML = ''; // Kosongkan tampilan

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'position-relative me-2 mb-2';
            div.innerHTML = `
                <img src="${e.target.result}" class="rounded shadow-sm border" 
                     style="width: 80px; height: 80px; object-fit: cover;">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                      onclick="removeFile(${index})" style="cursor:pointer;">&times;</span>
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
    updateInputFiles();
}

function removeFile(index) {
    selectedFiles.splice(index, 1); // Hapus dari array
    renderPreviews(); // Render ulang
}

function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('image-upload').files = dataTransfer.files;
}
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // Menghubungkan semua elemen yang memiliki atribut data-fancybox yang diawali dengan "gallery-"
    Fancybox.bind('[data-fancybox^="gallery-"]', {
        infinite: true, // Bisa geser terus menerus
        hideScrollbar: true,
        transitionEffect: "slide", // Efek geser
        Thumbs: {
            autoStart: false // Sembunyikan thumbnail bawah agar lebih bersih
        },
        Toolbar: {
            display: {
                left: ["infobar"],
                right: ["slideshow", "fullscreen", "download", "close"],
            },
        },
    });
});
</script>

</body>

</html>