<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cara_order extends CI_Controller {
    public function index() {
        $data['title'] = "Cara Order - CV. ABADI JAYA MITRA";
        $this->load->view('templates/header_front', $data);
        $this->load->view('templates/navbar_front', $data);
        $this->load->view('cara_order');
        $this->load->view('templates/footer_front');
    }
}