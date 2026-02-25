<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth');
        $this->load->library('session');
    }

    public function index()
    {
        // Jika sudah login, jangan balik ke login page
        if ($this->session->userdata('logged_in') === TRUE) {
            redirect('dashboard');
        }

        $this->load->view('login_page');
    }

    public function login_process()
    {
        // Pastikan hanya POST
        if ($this->input->method() !== 'post') {
            redirect('auth');
        }

        $username = trim($this->input->post('username', TRUE));
        $password = $this->input->post('password');

        // Cegah input kosong
        if ($username === '' || $password === '') {
            $this->session->set_flashdata('msg', 'Username dan password wajib diisi');
            redirect('auth');
        }

        $user = $this->M_Auth->check_login($username);

        if ($user && password_verify($password, $user['password'])) {

            // Regenerasi session ID (anti session hijacking)
            $this->session->sess_regenerate(TRUE);

            $this->session->set_userdata([
                'id_user'   => $user['id_user'],
                'username'  => $user['username'],
                'logged_in' => TRUE
            ]);

            $this->session->set_flashdata('msg', 'Anda berhasil login');
            redirect('dashboard');

        } else {

            $this->session->set_flashdata('msg', 'Username atau password salah');
            redirect('auth');
        }
    }

    public function logout()
    {
        // Hapus session dengan benar
        $this->session->sess_destroy();
        redirect('auth');
    }
}