<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

    public function index()
    {
        $data['title'] = "Kontak Kami - CV. ABADI JAYA MITRA";
        
        // Kita tetap tuliskan pemanggilan header agar nanti saat perbaikan lebih mudah
        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('kontak'); 
        $this->load->view('templates/footer_front');
    }
}