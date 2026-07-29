<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

    // 1. Mengambil semua data barang (diurutkan dari yang terbaru)
    public function get_all() {
        $this->db->order_by('id_barang', 'DESC');
        return $this->db->get('tbl_barang')->result();
    }

    // 2. Menambah data baru
    public function insert($data) {
        return $this->db->insert('tbl_barang', $data);
    }

    // 3. Mengubah data berdasarkan ID
    public function update($id, $data) {
        $this->db->where('id_barang', $id);
        return $this->db->update('tbl_barang', $data);
    }

    // 4. Menghapus data berdasarkan ID
    public function delete($id) {
        $this->db->where('id_barang', $id);
        return $this->db->delete('tbl_barang');
    }
}
