<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Produk'); // Load model produk
    }

    public function index() {
        $this->load->model('M_Testimoni');
        $keyword = $this->input->get('search');
        $id_kategori = $this->input->get('kategori');
        
        $data['title'] = "CV. ABADI JAYA MITRA - Solusi Pengadaan Barang";
        $data['hot_keywords'] = $this->M_Produk->get_hot_keywords(8);

        if ($keyword) {
            $this->M_Produk->record_keyword($keyword);
            $data['produk'] = $this->M_Produk->search_produk($keyword);
            $data['judul_halaman'] = "Hasil Pencarian: " . $keyword;
            $data['is_best_seller'] = false;
        } elseif ($id_kategori) {
            $data['produk'] = $this->M_Produk->get_barang_by_kategori($id_kategori);
            $nama_kat = !empty($data['produk']) ? $data['produk'][0]['nama_kategori'] : 'Kosong';
            $data['judul_halaman'] = "Kategori: " . $nama_kat;
            $data['is_best_seller'] = false;
        } else {
            // MENGGUNAKAN FUNGSI BARU DI MODEL (Sudah ada JOIN)
            $data['produk'] = $this->M_Produk->get_best_seller(12);
            $data['judul_halaman'] = "Produk Terpopuler";
            $data['is_best_seller'] = true;
        }
        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('templates/hero_section', $data);
        $this->load->view('landing_page', $data); // Ini hanya isi kontennya saja
        $this->load->view('templates/footer_front');
    }

    public function detail($id) {
        $this->M_Produk->update_counter($id);
        $data['produk'] = $this->M_Produk->get_produk_by_id($id);
        
        if (!$data['produk']) { redirect('home'); }

        // Ambil Produk Satu Kategori
        $data['terkait'] = $this->M_Produk->get_produk_terkait($data['produk']['id_kategori'], $id);
        
        // Ambil Produk Acak (Discovery)
        $data['random_products'] = $this->M_Produk->get_produk_random($id);

        $data['galeri'] = $this->M_Produk->get_galeri($id);
        $data['hot_keywords'] = $this->M_Produk->get_hot_keywords();
        $data['title'] = $data['produk']['nama_barang'] . " - CV. ABADI JAYA MITRA";

        $this->load->view('templates/header_front', $data);
        $this->load->view('detail_produk', $data);
        $this->load->view('templates/footer_front');
    }
    
    public function get_autosuggest()
    {
        // Gunakan null coalescing operator (?? "") untuk menjamin tidak null
        $keyword = $this->input->post('keyword') ?? "";
        
        if (trim($keyword) === "") {
            return; 
        }

        // Gunakan Query Builder CI yang lebih aman
        $this->db->select('id_produk, nama_barang, foto_barang');
        $this->db->from('produk');
        $this->db->like('nama_barang', $keyword);
        $this->db->limit(5); 
        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            foreach ($query as $row) {
                $slug = url_title($row['nama_barang'], 'dash', TRUE);
                $foto = base_url('assets/img/produk/' . $row['foto_barang']);
                
                echo '<a href="'.base_url('home/detail/'.$row['id_produk']).'" class="suggest-item text-decoration-none">';
                echo '  <div class="d-flex align-items-center w-100 p-2 border-bottom">';
                echo '      <img src="'.$foto.'" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">';
                echo '      <div class="flex-grow-1">';
                echo '          <div class="fw-bold text-dark small">'.$row['nama_barang'].'</div>';
                echo '          <div class="text-muted" style="font-size: 11px;">Lihat detail produk</div>';
                echo '      </div>';
                echo '      <i class="fas fa-chevron-right text-muted small"></i>';
                echo '  </div>';
                echo '</a>';
            }
        } else {
            echo '<div class="p-3 text-center text-muted small">Produk tidak ditemukan</div>';
        }
    }
        
}