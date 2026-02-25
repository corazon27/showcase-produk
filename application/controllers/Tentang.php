<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {

    public function index()
    {
        // Judul halaman untuk tab browser
        $data['title'] = "Tentang Kami - CV. ABADI JAYA MITRA";
        
        // Memanggil template header, view utama, dan footer
        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('tentang_kami'); 
        $this->load->view('templates/footer_front');
    }
}