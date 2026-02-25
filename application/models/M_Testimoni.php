<?php
class M_Testimoni extends CI_Model {
    public function get_all() {
        return $this->db->order_by('id_testi', 'DESC')->get('testimoni')->result_array();
    }
    
    public function get_active() {
        return $this->db->get_where('testimoni', ['status' => 'tampil'])->result_array();
    }

    public function insert($data) {
        return $this->db->insert('testimoni', $data);
    }

    public function delete($id) {
        return $this->db->delete('testimoni', ['id_testi' => $id]);
    }

    public function update($id, $data) {
        return $this->db->where('id_testi', $id)->update('testimoni', $data);
    }

    public function insert_testimoni($data_testimoni, $data_foto) {
        $this->db->trans_start();
    
    // 1. Simpan data teks ke tabel utama (status default: sembunyikan)
        $this->db->insert('testimoni', $data_testimoni);
        $id_testi = $this->db->insert_id();
        
        // 2. Simpan semua nama foto ke tabel testimoni_foto
        if (!empty($data_foto)) {
            foreach ($data_foto as $foto) {
                $this->db->insert('testimoni_foto', [
                    'id_testi' => $id_testi,
                    'nama_foto'    => $foto
                ]);
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}