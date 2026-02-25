<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Produk');
    }

    public function index() {
        $slug_kategori = $this->input->get('kategori');
        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'DESC';
        
        $data['kategori_aktif'] = 'Semua Kategori';
        $data['id_kategori_aktif'] = null;
        $id_kategori = null;

        if ($slug_kategori) {
            // Gunakan pencarian slug yang lebih presisi
            $this->db->group_start();
            $this->db->where("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(nama_kategori, ' ', '-'), '(', ''), ')', ''), '&', '-')) =", $slug_kategori);
            $this->db->or_where("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(nama_kategori, ' & ', '-'), ' ', '-'), '(', ''), ')', '')) =", $slug_kategori);
            $this->db->group_end();
            
            $kat = $this->db->get('kategori')->row_array();
            
            if ($kat) {
                $data['kategori_aktif'] = $kat['nama_kategori'];
                $id_kategori = $kat['id_kategori'];
                $data['id_kategori_aktif'] = $id_kategori;
            } else {
                // Jika slug ada tapi tidak ditemukan di DB, set kategori_aktif untuk tampilan "Ups!"
                $data['kategori_aktif'] = str_replace('-', ' ', $slug_kategori);
            }
        }

        // KONSISTENSI: Gunakan angka 12 di semua tempat
        $limit_awal = 12;
        $offset_awal = 0;
        
        $data['produk'] = $this->M_Produk->get_katalog_paged($limit_awal, $offset_awal, $id_kategori, $sort);
        
        if ($id_kategori) {
            $data['judul_halaman'] = "Kategori: " . $data['kategori_aktif'];
        } else {
            $data['judul_halaman'] = "Semua Produk Kami";
        }

        // Logika Rekomendasi
        if (empty($data['produk'])) {
            $data['rekomendasi'] = $this->db->order_by('id_produk', 'RANDOM')
                                            ->limit(8)
                                            ->get('produk')
                                            ->result_array();
        } else {
            $data['rekomendasi'] = [];
        }

        $data['title'] = ($id_kategori) ? "Jual " . $data['kategori_aktif'] . " - CV. ABADI JAYA MITRA" : "Katalog Produk - CV. ABADI JAYA MITRA";
        $data['hot_keywords'] = $this->M_Produk->get_hot_keywords();
        $data['semua_kategori'] = $this->db->get('kategori')->result_array();

        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('templates/hero_section', $data);
        $this->load->view('katalog_page', $data);
        $this->load->view('templates/footer_front');
    }

    // Fungsi AJAX untuk mengambil data berikutnya
    public function load_more() {
        $offset   = $this->input->post('offset');
        $kategori = $this->input->post('kategori'); 
        $sort     = $this->input->post('sort');
        $limit    = 12; // Pastikan sama dengan index

        $produk = $this->M_Produk->get_katalog_paged($limit, $offset, $kategori, $sort);
        
        // Kembalikan JSON (Penting: Pastikan Model mengembalikan nama_kategori & views)
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($produk));
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
        $keyword = $this->input->post('keyword');
        // Cari produk yang namanya mirip dengan keyword
        $this->db->like('nama_barang', $keyword);
        $this->db->limit(5); // Batasi 5 saran saja agar rapi
        $query = $this->db->get('produk')->result_array();

        if (count($query) > 0) {
            foreach ($query as $row) {
                $slug = url_title($row['nama_barang'], 'dash', TRUE);
                echo '<a href="'.base_url('detail/'.$slug.'/'.$row['id_produk']).'" class="suggest-item">';
                echo '  <i class="fas fa-search text-muted me-3"></i>';
                echo '  <span>'.$row['nama_barang'].'</span>';
                echo '</a>';
            }
        } else {
            echo '<div class="p-3 text-muted small">Produk tidak ditemukan...</div>';
        }
    }
}