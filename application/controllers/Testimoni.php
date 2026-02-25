<?php
class Testimoni extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Testimoni');
    }

    // --- HALAMAN PUBLIK (Untuk Pengunjung) ---
    public function index() {
        // 1. Tangkap id_kategori dari URL
        $id_kat = $this->input->get('kategori');

        // 2. Siapkan kueri dasar dengan JOIN kategori
        $this->db->select('testimoni.*, kategori.nama_kategori');
        $this->db->from('testimoni');
        $this->db->join('kategori', 'testimoni.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('testimoni.status', 'tampil');

        // 3. LOGIKA FILTER: Tambahkan WHERE jika ada kategori dipilih
        if (!empty($id_kat)) {
            $this->db->where('testimoni.id_kategori', $id_kat);
        }

        // 4. Hitung TOTAL TESTIMONI yang sesuai filter (untuk Load More/Pagination)
        // Clone kueri sebelum dijalankan get() karena get() akan mereset kueri builder
        $temp_db = clone $this->db;
        $data['total_testi'] = $temp_db->count_all_results();

        // 5. Jalankan Kueri Utama dengan Limit
        $this->db->limit(6, 0); 
        $this->db->order_by('testimoni.id_testi', 'DESC'); // Opsional: Tampilkan yang terbaru
        $data['testimoni'] = $this->db->get()->result_array();

        // 6. Ambil list kategori untuk dropdown filter
        $data['kategori'] = $this->db->get('kategori')->result_array();
        
        $data['title'] = "Testimoni Pelanggan - CV. ABADI JAYA MITRA";

        // Load views
        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('testimoni_page', $data);
        $this->load->view('templates/footer_front');
    }

    public function kirim() {
        $data_foto = [];
        $files = $_FILES['foto_testimoni'];

        // Konfigurasi Upload
        $config['upload_path']   = './assets/img/testi/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);
        $foto = 'default_user.png'; 
        if ($this->upload->do_upload('foto_pelanggan')) {
            $foto = $this->upload->data('file_name');
        }

        // Proses multi-upload
        foreach ($files['name'] as $key => $image) {
            $_FILES['file']['name']     = $files['name'][$key];
            $_FILES['file']['type']     = $files['type'][$key];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['file']['error']    = $files['error'][$key];
            $_FILES['file']['size']     = $files['size'][$key];

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $data_foto[] = $uploadData['file_name'];
            }
        }

        $data_testimoni = [
            'nama_pelanggan' => $this->input->post('nama', true),
            'instansi'       => $this->input->post('instansi', true),
            'isi_testimoni'  => $this->input->post('isi', true),
            'id_kategori'    => $this->input->post('id_kategori'),
            'foto_pelanggan' => $foto,
            'status'         => 'pending',
            'date_created'   => date('Y-m-d H:i:s')
        ];

        $simpan = $this->M_Testimoni->insert_testimoni($data_testimoni, $data_foto);
        
        if ($simpan) {
            $this->session->set_flashdata('success', 'Testimoni berhasil dikirim, menunggu verifikasi admin.');
            redirect('testimoni');
        }
    }

    // Fungsi untuk dipanggil via AJAX
    public function load_more() {
        $offset = $this->input->post('offset'); // Mengambil urutan data ke berapa
        $limit = 6;
        
        $testimoni = $this->db->get_where('testimoni', ['status' => 'tampil'], $limit, $offset)->result_array();
        
        // Kirim data dalam bentuk HTML ke JavaScript
        foreach($testimoni as $t) {
            echo '
            <div class="col-md-4 testi-item">
                <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                    <i class="fas fa-quote-left fa-2x text-primary opacity-25 mb-3"></i>
                    <p class="text-secondary mb-4">"'. $t['isi_testimoni'] .'"</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="'. base_url('assets/img/testi/'.$t['foto_pelanggan']) .'" 
                            class="rounded-circle me-3" width="50" height="50" style="object-fit:cover;">
                        <div>
                            <h6 class="fw-bold mb-0">'. $t['nama_pelanggan'] .'</h6>
                            <small class="text-primary">'. $t['instansi'] .'</small>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}