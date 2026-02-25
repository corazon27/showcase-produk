<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('auth');
        $this->load->model('M_Kategori');
    }

    public function index() {
        $data['title'] = 'Kategori Barang';
        $data['kategori'] = $this->M_Kategori->get_all();
        $data['content'] = 'admin/kategori/index'; // Folder views/admin/kategori/index.php
        $this->load->view('templates/layout', $data);
    }

    public function tambah() {
        $nama = $this->input->post('nama_kategori');
        $this->M_Kategori->insert(['nama_kategori' => $nama]);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambah!');
        redirect('kategori');
    }

    public function hapus($id) {
        $this->M_Kategori->delete($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        redirect('kategori');
    }
}