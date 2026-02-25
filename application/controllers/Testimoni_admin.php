<?php
class Testimoni_admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Testimoni');
    }

    public function index() {
        $data['title'] = 'Data Testimoni - CV. ABADI JAYA MITRA';
        $data['testimoni'] = $this->M_Testimoni->get_all();
        $data['content'] = 'admin/testimoni/kelola_testimoni'; // Folder views/admin/testimoni/kelola_testimoni.php
        $this->load->view('templates/layout', $data);
    }
    
    // --- HALAMAN ADMIN (Untuk Verifikasi) ---
    public function kelola() {
        // Tampilkan semua data untuk admin (pending & tampil)
        $data['title'] = 'Data Testimoni - CV. ABADI JAYA MITRA';
        $data['testimoni'] = $this->M_Testimoni->get_all();
        $data['content'] = 'admin/testimoni/kelola_testimoni'; // Folder views/admin/testimoni/kelola_testimoni.php
        $this->load->view('templates/layout', $data);
    }

    public function verifikasi($id, $status) {
        // Status bisa 'tampil' atau 'pending'
        $this->M_Testimoni->update($id, ['status' => $status]);
        redirect('testimoni-admin/kelola');
    }

    public function hapus($id) {
        $this->M_Testimoni->delete($id);
        redirect('testimoni-admin/kelola');
    }

    public function hapus_foto($id_foto) {
        // 1. Cari data foto di database untuk mendapatkan nama filenya
        $foto = $this->db->get_where('testimoni_foto', ['id_foto' => $id_foto])->row();

        if ($foto) {
            $path = './assets/img/testi/' . $foto->nama_foto;

            // 2. Hapus file fisik dari folder assets jika ada
            if (file_exists($path)) {
                unlink($path);
            }

            // 3. Hapus data dari tabel testimoni_foto
            $this->db->delete('testimoni_foto', ['id_foto' => $id_foto]);
            
            // Kirim respon sukses ke AJAX
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Foto tidak ditemukan']);
        }
    }
}