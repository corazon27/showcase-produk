<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('auth');
        $this->load->model(['M_Produk', 'M_Kategori']);
        $this->load->library('upload');
    }

    public function index() {
        $data['title'] = 'Data Produk - CV. ABADI JAYA MITRA';
        $data['produk'] = $this->M_Produk->get_all();
        $data['kategori'] = $this->M_Kategori->get_all();
        $data['content'] = 'admin/produk/index';
        $this->load->view('templates/layout', $data);
    }

    public function tambah() {
        // Menghasilkan angka acak antara 1000 sampai 9999
        $id_acak = rand(1000, 9999);

        // Pastikan ID tersebut belum ada di database (agar tidak duplikat)
        $cek = $this->db->get_where('produk', ['id_produk' => $id_acak])->num_rows();
        
        while ($cek > 0) {
            $id_acak = rand(1000, 9999);
            $cek = $this->db->get_where('produk', ['id_produk' => $id_acak])->num_rows();
        }
        $config['upload_path']   = './assets/img/produk/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name']     = 'prod_'.time();
        $config['max_size'] = '2048'; // Maksimal 2MB
        $config['max_width'] = '2000'; // Maksimal lebar 2000px

        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto_barang')) {
            $gambar = $this->upload->data('file_name');
            $save = [
                'id_produk'   => $id_acak,
                'nama_barang'       => $this->input->post('nama_barang'),
                'id_kategori'       => $this->input->post('id_kategori'),
                'deskripsi_singkat' => $this->input->post('deskripsi_singkat'),
                'foto_barang'       => $gambar,
                'date_created'      => date('Y-m-d H:i:s'),
                'slug' => url_title($nama_barang, 'dash', TRUE)
            ];
            $this->M_Produk->insert($save);
            $this->session->set_flashdata('success', 'Produk berhasil dipajang!');
            redirect('input-produk');
        } else {
            // Jika upload gagal
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('input-produk');
        }
    }

   public function simpan_galeri() {
        $id_produk = $this->input->post('id_produk');
        
        // 1. Pastikan ID Produk ada
        if (!$id_produk) {
            $this->session->set_flashdata('error', 'ID Produk tidak ditemukan.');
            redirect('input-produk');
        }

        // 2. Konfigurasi Upload
        $config['upload_path']   = './assets/img/produk/';
        $config['allowed_types'] = 'jpg|png|jpeg|webp';
        $config['encrypt_name']  = TRUE;
        $config['max_size']      = '2048';

        // 3. Load library dan INITIALIZE (Penting!)
        $this->load->library('upload');
        $this->upload->initialize($config);

        // 4. Proses Upload
        if ($this->upload->do_upload('foto_tambahan')) {
            $fileData = $this->upload->data();
            $data = [
                'id_produk'     => $id_produk,
                'foto_tambahan' => $fileData['file_name']
            ];
            
            // Simpan ke database
            $this->db->insert('produk_galeri', $data);
            $this->session->set_flashdata('success', 'Foto galeri berhasil ditambahkan!');
        } else {
            // Ambil pesan error jika upload gagal
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
        }

        redirect('input-produk');
    }

    public function edit_produk($id) {
        $data['produk'] = $this->db->get_where('produk', ['id_produk' => $id])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['title'] = "Edit Data Produk";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function proses_edit_produk() {
        $id = $this->input->post('id_produk');
        $foto_lama = $this->input->post('foto_lama');

        $data = [
            'nama_barang'       => $this->input->post('nama_barang'),
            'id_kategori'       => $this->input->post('id_kategori'),
            'deskripsi_singkat' => $this->input->post('deskripsi_singkat'),
            'slug'              => url_title($this->input->post('nama_barang'), 'dash', TRUE)
        ];

        // Cek jika ada file yang diupload
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']   = './assets/img/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'prod_' . time(); // Nama unik agar tidak bentrok

            $this->load->library('upload', $config);
            $this->upload->initialize($config); // PENTING: Agar konfigurasi terbaca

            if ($this->upload->do_upload('foto')) {
                // Jika upload berhasil, ambil nama file baru
                $file_baru = $this->upload->data('file_name');
                $data['foto_barang'] = $file_baru;

                // Hapus foto lama dari folder agar tidak menumpuk
                if ($foto_lama && $foto_lama != 'default.jpg') {
                    if (file_exists('./assets/img/produk/' . $foto_lama)) {
                        unlink('./assets/img/produk/' . $foto_lama);
                    }
                }
            } else {
                // Opsional: Jika gagal upload, tampilkan pesan error untuk debug
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('input-produk');
            }
        }

        $this->db->where('id_produk', $id); // Pastikan menggunakan id_produk
        $this->db->update('produk', $data); // Sesuaikan nama tabel Anda
        
        $this->session->set_flashdata('pesan', 'Produk berhasil diupdate!');
        redirect('input-produk');
    }

    public function hapus($id) {
        $this->M_Produk->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
        redirect('input-produk');
    }

    public function hapus_galeri($id) {
        // 1. Ambil data foto dari DB untuk hapus filenya di folder
        $row = $this->db->get_where('produk_galeri', ['id_galeri' => $id])->row();
        if ($row) {
            $path = './assets/img/produk/' . $row->foto_tambahan;
            if (file_exists($path)) {
                unlink($path); // Menghapus file fisik
            }
        }

        // 2. Hapus data di database
        $this->db->delete('produk_galeri', ['id_galeri' => $id]);
        
        $this->session->set_flashdata('success', 'Foto galeri berhasil dihapus!');
        redirect('input-produk');
    }

    public function get_produk_by_id($id) {
        // Ambil data berdasarkan id_produk sesuai database Anda
        $p = $this->db->get_where('produk', ['id_produk' => $id])->row_array();
        $kategori = $this->db->get('kategori')->result_array();

        if ($p) {
            $html = '
            <input type="hidden" name="id_produk" value="'.$p['id_produk'].'">
            <input type="hidden" name="foto_lama" value="'.$p['foto_barang'].'">
            
            <div class="mb-3">
                <label class="fw-bold">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="'.$p['nama_barang'].'" required>
            </div>
            
            <div class="mb-3">
                <label class="fw-bold">Kategori</label>
                <select name="id_kategori" class="form-select">';
                foreach($kategori as $k) {
                    $sel = ($k['id_kategori'] == $p['id_kategori']) ? 'selected' : '';
                    $html .= '<option value="'.$k['id_kategori'].'" '.$sel.'>'.$k['nama_kategori'].'</option>';
                }
            $html .= '</select>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Deskripsi</label>
                <textarea name="deskripsi_singkat" class="form-control" rows="3">'.$p['deskripsi_singkat'].'</textarea>
            </div>

            <div class="mb-3 text-center">
                <label class="d-block text-start fw-bold mb-2">Foto Saat Ini</label>
                <img src="'.base_url('assets/img/produk/'.$p['foto_barang']).'" 
                    id="preview-foto-edit" 
                    class="img-thumbnail mb-2" 
                    style="max-height: 150px;">
                    
                <input type="file" name="foto" id="input-foto-edit" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </div>';
            echo $html;
        } else {
            echo "Data tidak ditemukan.";
        }
    }

    public function get_ajax_produk() {
        $list = $this->M_Produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $p) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img src="'.base_url('assets/img/produk/').$p->foto_barang.'" width="50" class="img-thumbnail">';
            $row[] = $p->nama_barang;
            $row[] = $p->nama_kategori;
            $row[] = $p->deskripsi_singkat;

            // Tambahkan semua tombol aksi di sini
            $row[] = '
                <div class="text-center">
                    <button type="button" class="btn btn-sm btn-info btn-edit" data-id="'.$p->id_produk.'" title="Edit">
                        <i class="fas fa-edit text-white"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary btn-galeri" data-id="'.$p->id_produk.'">
                        <i class="fas fa-images"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="'.$p->id_produk.'" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Produk->count_all(),
            "recordsFiltered" => $this->M_Produk->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_galeri_by_id($id) {
        $p = $this->db->get_where('produk', ['id_produk' => $id])->row_array();
        $list_galeri = $this->db->get_where('produk_galeri', ['id_produk' => $id])->result_array();

        $html = '<input type="hidden" name="id_produk" value="'.$id.'">
                <h6>Produk: <b>'.$p['nama_barang'].'</b></h6>
                <div class="mb-3">
                    <label>Tambah Foto (Max 5)</label>
                    <input type="file" name="foto_tambahan" class="form-control" required>
                </div>
                <hr>
                <h6>Foto Terpasang:</h6>
                <div class="row no-gutters">';

        if(!empty($list_galeri)) {
            foreach($list_galeri as $lg) {
                $html .= '<div class="col-4 p-1 text-center">
                            <div class="position-relative border rounded p-1">
                                <img src="'.base_url('assets/img/produk/'.$lg['foto_tambahan']).'" class="img-fluid" style="height:80px; width:100%; object-fit:cover;">
                                <a href="'.base_url('input-produk/hapus_galeri/'.$lg['id_galeri']).'" class="btn btn-xs btn-danger position-absolute" style="top:0; right:0;" onclick="return confirm(\'Hapus foto?\')">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>';
            }
        } else {
            $html .= '<div class="col-12 alert alert-light text-center small">Belum ada foto tambahan.</div>';
        }
        $html .= '</div>';
        echo $html;
    }
}