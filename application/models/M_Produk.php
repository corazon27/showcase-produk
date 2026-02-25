<?php
class M_Produk extends CI_Model {

    var $table = 'produk'; 
        var $column_order = array(null, 'foto_barang', 'nama_barang', 'id_kategori', 'deskripsi_singkat', null);
        var $column_search = array('nama_barang', 'deskripsi_singkat', 'kategori.nama_kategori'); // Kolom yang bisa dicari
        var $order = array('id_produk' => 'desc'); // Urutan default
        public function get_all() {
            $this->db->select('produk.*, kategori.nama_kategori');
            $this->db->from('produk');
            $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
            return $this->db->get()->result_array();
    }

    private function _get_datatables_query() {
        // Join dengan tabel kategori untuk mendapatkan nama_kategori
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from($this->table);
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_all_produk_katalog($sort = 'DESC') {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
        
        // Gunakan helper sort agar konsisten
        $this->_apply_sort($sort);
        
        return $this->db->get()->result_array();
    }

    public function get_barang_by_kategori($id_kategori, $sort = 'DESC') {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('produk.id_kategori', $id_kategori);
        
        $this->_apply_sort($sort);
        
        return $this->db->get()->result_array();
    }

    // Fungsi private agar kita tidak menulis kode sort berulang-ulang
    private function _apply_sort($sort) {
        if ($sort == 'AZ') {
            $this->db->order_by('nama_barang', 'ASC');
        } elseif ($sort == 'ZA') {
            $this->db->order_by('nama_barang', 'DESC');
        } elseif ($sort == 'MV') {
            $this->db->order_by('views', 'DESC');
        } elseif ($sort == 'LV') {
            $this->db->order_by('views', 'ASC'); 
        } elseif ($sort == 'ASC') {
            $this->db->order_by('id_produk', 'ASC');
        } else {
            $this->db->order_by('id_produk', 'DESC');
        }
    }

    // Tambahkan parameter $kategori dan $sort di function ini
    public function get_katalog_paged($limit, $offset, $kategori = null, $sort = 'DESC') {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');

        // Filter kategori jika ID diberikan
        if ($kategori != null && $kategori != "") {
            $this->db->where('produk.id_kategori', $kategori);
        }

        // LOGIKA SORTIR LENGKAP (Menyesuaikan dengan Dropdown di View)
        if ($sort == 'ASC') {
            $this->db->order_by('produk.date_created', 'ASC'); 
        } elseif ($sort == 'AZ') {
            $this->db->order_by('produk.nama_barang', 'ASC');
        } elseif ($sort == 'ZA') {
            $this->db->order_by('produk.nama_barang', 'DESC');
        } elseif ($sort == 'MV') {
            // Most Viewed: Terpopuler berdasarkan kolom views
            $this->db->order_by('produk.views', 'DESC');
        } elseif ($sort == 'LV') {
            // Least Viewed: Kurang Populer
            $this->db->order_by('produk.views', 'ASC');
        } else {
            // Default: Terbaru
            $this->db->order_by('produk.date_created', 'DESC');
        }

        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function get_best_seller($limit = 10) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        $this->db->order_by('produk.views', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function insert($data) {
        return $this->db->insert('produk', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    }

    public function delete($id) {
        return $this->db->delete('produk', ['id_produk' => $id]);
    }

    public function search_produk($keyword) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->like('nama_barang', $keyword); // Mencari yang mirip dengan keyword
        $this->db->or_like('nama_kategori', $keyword); // Bisa juga mencari berdasarkan kategori
        return $this->db->get()->result_array();
    }

    // Simpan atau update hitungan keyword
    public function record_keyword($keyword) {
        $keyword = strtolower(trim($keyword));
        $cek = $this->db->get_where('pencarian', ['keyword' => $keyword])->row();

        if ($cek) {
            $this->db->set('jumlah_hit', 'jumlah_hit+1', FALSE);
            $this->db->where('keyword', $keyword);
            $this->db->update('pencarian');
        } else {
            $this->db->insert('pencarian', ['keyword' => $keyword]);
        }
    }

    // Ambil 5 keyword paling sering dicari
    public function get_hot_keywords() {
        $this->db->order_by('jumlah_hit', 'DESC');
        $this->db->limit(5);
        return $this->db->get('pencarian')->result_array();
    }

    public function get_produk_by_id($id) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        // Join dengan tabel kategori agar nama kategori muncul, bukan hanya ID
        $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
        $this->db->where('produk.id_produk', $id);
        return $this->db->get()->row_array();
    }

    public function update_counter($id) {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('id_produk', $id);
        $this->db->update('produk');
    }

    public function get_galeri($id) {
        return $this->db->get_where('produk_galeri', ['id_produk' => $id])->result_array();
    }

    public function get_produk_terkait($id_kategori, $id_produk_sekarang, $limit = 4) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        $this->db->where('produk.id_kategori', $id_kategori);
        $this->db->where('produk.id_produk !=', $id_produk_sekarang); // Agar produk yg sama tdk muncul
        $this->db->order_by('id_produk', 'RANDOM'); // Acak produk yang muncul
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_produk_random($id_produk_sekarang, $limit = 4) {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        $this->db->where('produk.id_produk !=', $id_produk_sekarang); // Tetap sembunyikan produk yang sedang dilihat
        $this->db->order_by('id_produk', 'RANDOM'); 
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    public function get_by_slug($slug) {
        return $this->db->get_where('produk', ['slug' => $slug])->row();
    }


}