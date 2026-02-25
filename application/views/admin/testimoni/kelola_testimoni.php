<div class="container py-5">
    <h3 class="fw-bold mb-4">Daftar Testimoni Masuk</h3>
    <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>Instansi</th>
                    <th>Pesan</th>
                    <th>Foto Pelanggan</th>
                    <th>Foto Dokumentasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($testimoni as $t) : ?>
                <tr>
                    <td><span class="fw-bold"><?= $t['nama_pelanggan']; ?></span></td>
                    <td><?= $t['instansi']; ?></td>
                    <td><small class="text-muted"><?= $t['isi_testimoni']; ?></small></td>

                    <td>
                        <img src="<?= base_url('assets/img/testi/'.$t['foto_pelanggan']); ?>" width="50" height="50"
                            class="rounded-circle object-fit-cover border" alt="User">
                    </td>

                    <td>
                        <div class="d-flex flex-wrap gap-1" style="max-width: 150px;">
                            <?php 
                            $fotos = $this->db->get_where('testimoni_foto', ['id_testi' => $t['id_testi']])->result_array();
                            $limit = 3;
                            
                            foreach(array_slice($fotos, 0, $limit) as $index => $f) : 
                                $is_over = ($index === $limit - 1 && count($fotos) > $limit);
                            ?>
                            <div class="position-relative">
                                <a href="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                                    data-fancybox="admin-gallery-<?= $t['id_testi']; ?>"
                                    class="position-relative d-inline-block">

                                    <img src="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                                        class="rounded border shadow-sm" width="40" height="40"
                                        style="object-fit: cover;">

                                    <?php if($is_over) : ?>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded d-flex align-items-center justify-content-center"
                                        style="background: rgba(0,0,0,0.5); font-size: 10px; color: white; cursor: pointer;">
                                        +<?= count($fotos) - $limit; ?>
                                    </div>
                                    <?php endif; ?>
                                </a>
                                <button onclick="hapusFoto(<?= $f['id_foto']; ?>)"
                                    class="btn btn-danger btn-sm p-0 position-absolute top-0 start-100 translate-middle rounded-circle shadow"
                                    style="width: 16px; height: 16px; font-size: 10px; z-index: 2;">
                                    &times;
                                </button>
                            </div>
                            <?php endforeach; ?>

                            <?php foreach(array_slice($fotos, $limit) as $f) : ?>
                            <a href="<?= base_url('assets/img/testi/' . $f['nama_foto']); ?>"
                                data-fancybox="admin-gallery-<?= $t['id_testi']; ?>" class="d-none"></a>
                            <?php endforeach; ?>

                            <?php if(empty($fotos)) echo '<span class="text-muted small">Tidak ada foto</span>'; ?>
                        </div>
                    </td>

                    <td>
                        <?php if($t['status'] == 'pending'): ?>
                        <span
                            class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">Pending</span>
                        <?php else: ?>
                        <span
                            class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Tampil</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <div class="btn-group">
                            <?php if($t['status'] == 'pending'): ?>
                            <a href="<?= base_url('testimoni-admin/verifikasi/'.$t['id_testi'].'/tampil'); ?>"
                                class="btn btn-sm btn-primary">Setujui</a>
                            <?php else: ?>
                            <a href="<?= base_url('testimoni-admin/verifikasi/'.$t['id_testi'].'/pending'); ?>"
                                class="btn btn-sm btn-info">Sembunyikan</a>
                            <?php endif; ?>

                            <a href="<?= base_url('testimoni-admin/hapus/'.$t['id_testi']); ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Hapus seluruh testimoni ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>