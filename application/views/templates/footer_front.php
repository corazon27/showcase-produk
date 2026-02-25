<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <img src="<?= base_url('assets/img/logo_ajm.png'); ?>" alt="Logo"
                    style="height: 60px; margin-bottom: 20px;">
                <p class="small text-secondary">
                    CV. ABADI JAYA MITRA adalah mitra terpercaya dalam pengadaan Alat Tulis Kantor (ATK) dan perangkat
                    elektronik untuk instansi pemerintah maupun swasta.
                </p>
            </div>

            <div class="col-lg-2 offset-lg-1">
                <h5 class="fw-bold mb-3">Navigasi</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?= base_url(); ?>"
                            class="text-secondary text-decoration-none">Beranda</a></li>
                    <li class="mb-2"><a href="<?= base_url('tentang-kami'); ?>"
                            class="text-secondary text-decoration-none">Tentang Kami</a></li>
                    <li class="mb-2"><a href="<?= base_url('cara-order'); ?>"
                            class="text-secondary text-decoration-none">Cara Order</a></li>
                    <li class="mb-2"><a href="<?= base_url('kontak-kami'); ?>"
                            class="text-secondary text-decoration-none">Kontak</a></li>
                    <li class="mb-2"><a href="<?= base_url('testimoni'); ?>"
                            class="text-secondary text-decoration-none">Testimoni</a></li>
                </ul>
            </div>

            <div class="col-lg-5">
                <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <h6 class="text-primary mb-1 small fw-bold">Admin 1</h6>
                        <p class="small mb-0 text-secondary">+62 821-3640-5274</p>
                        <a href="https://wa.me/6282136405274"
                            class="btn btn-sm btn-outline-success mt-2 rounded-pill">Chat WhatsApp</a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <h6 class="text-primary mb-1 small fw-bold">Admin 2</h6>
                        <p class="small mb-0 text-secondary">+62 81225876355</p>
                        <a href="https://wa.me/6281225876355"
                            class="btn btn-sm btn-outline-success mt-2 rounded-pill">Chat WhatsApp</a>
                    </div>
                </div>
                <div class="footer-info">
                    <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                    <address class="text-secondary">
                        <p><i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <strong>Lokasi Kantor:</strong><br>
                            Perum Bumi Nusantara 1, <br>
                            Magelang, Jawa Tengah 56172
                        </p>
                        <p><i class="fas fa-envelope me-2 text-primary"></i>
                            abadijayamitra88@gmail.com
                        </p>
                    </address>

                    <a href="https://maps.app.goo.gl/6tk8SWfZYBSzeU5p8" target="_blank"
                        class="btn btn-sm btn-outline-light rounded-pill px-3">
                        <i class="fas fa-directions me-1"></i> Petunjuk Arah
                    </a>
                </div>
            </div>
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
    let jumlahAwal = $('#product-container').children().length;
    if (jumlahAwal < 8) {
        $('#load-more-btn').hide();
    }

    let offset = jumlahAwal;

    $('#load-more-btn').click(function() {
        let btn = $(this);
        const urlParams = new URLSearchParams(window.location.search);
        const kategori = "<?= $id_kategori_aktif; ?>";
        const sort = urlParams.get('sort') || 'DESC';

        btn.html('<span class="spinner-border spinner-border-sm"></span> Loading...').prop('disabled',
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
                        // PINDAHKAN LOGIKA SLUG KE SINI
                        let slug = p.nama_barang.toLowerCase()
                            .replace(/[()&]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');

                        html += `
                            <div class="col-md-3 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <img src="<?= base_url('assets/img/produk/'); ?>${p.foto_barang}" class="card-img-top" alt="${p.nama_barang}">
                                    <div class="card-body">
                                        <small class="text-primary">${p.nama_kategori}</small>
                                        <h5 class="card-title text-truncate">${p.nama_barang}</h5>
                                        <a href="<?= base_url('detail/'); ?>${slug}/${p.id_produk}" class="btn btn-success btn-sm w-100">Tanya Harga</a>
                                    </div>
                                </div>
                            </div>`;
                    });

                    let $newItems = $(html).hide();
                    $('#product-container').append($newItems);
                    $newItems.fadeIn(800);

                    offset += data.length;
                    btn.html('Muat Produk Lebih Banyak').prop('disabled', false);

                    if (data.length < 8) {
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
var offset = 6; // Karena 6 data awal sudah muncul
var total_testi = <?= $total_testi; ?>;

$('#load-more').click(function() {
    $.ajax({
        url: "<?= base_url('testimoni/load_more'); ?>",
        type: "post",
        data: {
            offset: offset
        },
        beforeSend: function() {
            $('#load-more').html('Memuat...'); // Efek loading
        },
        success: function(data) {
            if (data.trim() !== "") {
                $('#testi-container').append(data); // Tambahkan data baru ke container
                offset += 6; // Tambah offset untuk klik berikutnya
                $('#load-more').html('Muat Lebih Banyak');

                // Sembunyikan tombol jika semua data sudah muncul
                if (offset >= total_testi) {
                    $('#load-more').hide();
                }
            } else {
                $('#load-more').hide();
            }
        }
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