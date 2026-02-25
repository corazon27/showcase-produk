<?php
class M_Kategori extends CI_Model {

    public function get_all() {
        return $this->db->get('kategori')->result_array();
    }

    public function insert($data) {
        return $this->db->insert('kategori', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
    }

    public function update($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori', $data);
    }

    public function delete($id) {
        return $this->db->delete('kategori', ['id_kategori' => $id]);
    }
}