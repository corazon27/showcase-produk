<?php
class M_Auth extends CI_Model {
    public function check_login($user) {
        return $this->db->get_where('user', ['username' => $user])->row_array();
    }
}