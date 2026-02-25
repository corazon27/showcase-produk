<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['content'] = 'dashboard/index';
        $data['title']   = 'Dashboard';

        $this->load->view('templates/layout', $data);
    }
}