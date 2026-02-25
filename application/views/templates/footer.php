</div> <!-- content -->
</div> <!-- content-wrapper -->

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>&copy; <?= date('Y'); ?> CV. ABADI JAYA MITRA</span>
        </div>
    </div>
</footer>

</div> <!-- wrapper -->

<script src="<?= base_url('assets/sbadmin2/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<script src="<?= base_url('assets/sbadmin2/js/sb-admin-2.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<script>
// Pastikan dokumen sudah siap
document.addEventListener("DOMContentLoaded", function() {
    // Sesuaikan selektor dengan atribut data-fancybox di HTML Anda (admin-gallery-)
    Fancybox.bind('[data-fancybox^="admin-gallery-"]', {
        infinite: true,
        transitionEffect: "slide",
        // Menambahkan tombol navigasi eksplisit jika diperlukan
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: [],
                right: ["iterateZoom", "slideshow", "fullscreen", "download", "thumbs", "close"],
            },
        },
    });
});
</script>

<script>
// Logika untuk menampilkan alert dari flashdata
const flashData = "<?= $this->session->flashdata('success'); ?>";

if (flashData) {
    Swal.fire({
        title: 'Berhasil!',
        text: flashData,
        icon: 'success',
        confirmButtonText: 'OK'
    });
}

$('.btn-hapus').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data kategori akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});
</script>

<script>
function previewImage() {
    const image = document.querySelector('#image-source');
    const imgPreview = document.querySelector('#image-preview');

    // Menampilkan elemen img
    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>

<script>
function hapusFoto(idFoto) {
    if (confirm('Apakah Anda yakin ingin menghapus foto dokumentasi ini?')) {
        $.ajax({
            url: "<?= base_url('testimoni-admin/hapus_foto/'); ?>" + idFoto,
            type: "POST",
            dataType: "JSON",
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('Gagal menghapus foto: ' + response.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan pada server.');
            }
        });
    }
}
</script>

<script>
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    $('#modalEdit').modal('show');
    $('#modalEdit').on('hidden.bs.modal', function() {
        $('#isiModalEdit').html(''); // Kosongkan isi modal saat ditutup
    });
    $.ajax({
        url: "<?= base_url('input-produk/get_produk_by_id/'); ?>" + id,
        type: 'GET',
        success: function(data) {
            $('#isiModalEdit').html(data);
        },
        error: function(xhr) {
            console.log(xhr.responseText); // Lihat detail error di console jika masih 404
        }
    });
});
</script>

<script>
// Gunakan $(document).on karena elemen input dibuat secara dinamis oleh AJAX
$(document).on('change', '#input-foto-edit', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Mengganti atribut src pada gambar preview dengan file yang baru dipilih
            $('#preview-foto-edit').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>

<script>
$(document).ready(function() {
    $('#tabelProduk').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url('input-produk/get_ajax_produk') ?>",
            "type": "POST",
            "data": function(d) {
                // Mengirim token CSRF terbaru setiap kali request
                d.<?= $this->security->get_csrf_token_name(); ?> =
                    "<?= $this->security->get_csrf_hash(); ?>";
            }
        },
        "columnDefs": [{
            "targets": [0, 1, 5],
            "orderable": false,
        }],
    });
});
</script>

<script>
// Ganti kode klik lama Anda dengan ini
$(document).on('click', '.btn-edit', function() {
    const id = $(this).data('id');
    $('#modalEdit').modal('show');

    // Tampilkan loading
    $('#isiModalEdit').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

    $.ajax({
        url: "<?= base_url('input-produk/get_produk_by_id/'); ?>" + id,
        type: 'GET',
        success: function(response) {
            $('#isiModalEdit').html(response);
        }
    });
});
</script>

<script>
$(document).on('click', '.btn-hapus', function() {
    const id = $(this).data('id');
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        window.location.href = "<?= base_url('input-produk/hapus/'); ?>" + id;
    }
});
</script>

<script>
$(document).on('click', '.btn-galeri', function() {
    const id = $(this).data('id');
    $('#modalGaleri').modal('show');
    $('#isiModalGaleri').html(
        '<div class="text-center p-3"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

    $.ajax({
        url: "<?= base_url('input-produk/get_galeri_by_id/'); ?>" + id,
        type: 'GET',
        success: function(response) {
            $('#isiModalGaleri').html(response);
        }
    });
});
</script>




</body>

</html>