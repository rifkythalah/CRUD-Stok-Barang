<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Input $input
 * @property Barang_model $Barang_model
 */

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model
        $this->load->model('Barang_model');
    }

    // READ: Halaman utama, menampilkan tabel
    public function index() {
        // Ambil data dari model
        $data['barang'] = $this->Barang_model->get_all();
        // Menampilkan view 'barang' dengan membawa variabel $data
        $this->load->view('barang', $data);
    }

    // CREATE: Aksi saat form Tambah disubmit
    public function tambah_aksi() {
        // Validasi: kode barang wajib diisi dan harus unik di database
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[tbl_barang.kode_barang]');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kirim pesan error
            $this->session->set_flashdata('error', validation_errors());
        } else {
            // Jika berhasil, siapkan array data
            $data = array(
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'kategori'    => $this->input->post('kategori'),
                'stok'        => $this->input->post('stok'),
                'harga'       => $this->input->post('harga')
            );
            $this->Barang_model->insert($data);
            $this->session->set_flashdata('sukses', 'Data berhasil ditambahkan!');
        }
        redirect('barang');
    }

    // UPDATE: Aksi saat form Edit disubmit
    public function edit_aksi() {
        $id = $this->input->post('id_barang');
        
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'kategori'    => $this->input->post('kategori'),
            'stok'        => $this->input->post('stok'),
            'harga'       => $this->input->post('harga')
        );

        $this->Barang_model->update($id, $data);
        $this->session->set_flashdata('sukses', 'Data berhasil diubah!');
        
        redirect('barang');
    }

    // DELETE: Aksi saat tombol Hapus diklik
    public function hapus($id) {
        $this->Barang_model->delete($id);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus!');
        redirect('barang');
    }
}