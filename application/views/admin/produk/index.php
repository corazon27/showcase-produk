<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#tambahProduk">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelProduk" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal tambah data produk -->
<div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="<?= base_url('input-produk/tambah'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi_singkat" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <label class="d-block text-left">Foto Produk</label>
                        <input type="file" name="foto_barang" id="image-source" class="form-control-file"
                            onchange="previewImage();" required>

                        <div class="mt-3">
                            <img id="image-preview" src="" alt="Preview Gambar" class="img-thumbnail"
                                style="display:none; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal untuk tambah galeri produk -->
<?php foreach ($produk as $p) : ?>
<div class="modal fade" id="modalGaleri<?= $p['id_produk']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Galeri Foto: <?= $p['nama_barang']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('input-produk/simpan_galeri'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_produk" value="<?= $p['id_produk']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Tambah Foto Tambahan (Max 5)</label>
                        <input type="file" name="foto_tambahan" class="form-control" required>
                    </div>

                    <hr>
                    <h6>Foto Galeri Terpasang:</h6>
                    <div class="row no-gutters">
                        <?php 
    // Mengambil data galeri khusus untuk produk ini
    $list_galeri = $this->db->get_where('produk_galeri', ['id_produk' => $p['id_produk']])->result_array();
    
    if(!empty($list_galeri)) : 
        foreach($list_galeri as $lg) : ?>
                        <div class="col-4 p-1 text-center">
                            <div class="position-relative border rounded p-1">
                                <img src="<?= base_url('assets/img/produk/'.$lg['foto_tambahan']); ?>"
                                    class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">

                                <a href="<?= base_url('input-produk/hapus_galeri/'.$lg['id_galeri']); ?>"
                                    class="btn btn-xs btn-danger position-absolute"
                                    style="top: 0; right: 0; padding: 0px 5px;"
                                    onclick="return confirm('Hapus foto ini dari galeri?')">
                                    <i class="fas fa-times" style="font-size: 10px;"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; 
    else: ?>
                        <div class="col-12">
                            <div class="alert alert-light text-center small">
                                Belum ada foto tambahan untuk produk ini.
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- modal untuk edit data produk -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>"> -->
            <div class="modal-header">
                <h5 class="modal-title">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('input-produk/proses_edit_produk'); ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body" id="isiModalEdit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGaleri" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Galeri Foto</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('input-produk/simpan_galeri'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" id="isiModalGaleri">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>