<?php /** @var array $barang */ ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Stok Barang</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4 mb-5">

        <!-- ALERT-->
        <?php if($this->session->flashdata('sukses')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <strong>Sukses!</strong> <?= $this->session->flashdata('sukses') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <strong>Perhatian!</strong> <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <!-- Kartu Utama Tabel Data -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Stok Barang</h4>
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Barang
                </button>
            </div>
            <div class="card-body">
                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table id="tabel-barang" class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga (Rp)</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($barang as $b): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->kode_barang ?></td>
                                <td><?= $b->nama_barang ?></td>
                                <td><?= $b->kategori ?></td>
                                <td><?= $b->stok ?></td>
                                <td><?= number_format($b->harga, 0, ',', '.') ?></td>
                                <td>
                                    <!-- Tombol Edit (Membawa data ke modal via atribut data-*) -->
                                    <button class="btn btn-warning btn-sm btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit" data-id="<?= $b->id_barang ?>"
                                        data-kode="<?= $b->kode_barang ?>" data-nama="<?= $b->nama_barang ?>"
                                        data-kategori="<?= $b->kategori ?>" data-stok="<?= $b->stok ?>"
                                        data-harga="<?= $b->harga ?>">
                                        Edit
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <a href="<?= base_url('barang/hapus/'.$b->id_barang) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH BARANG          -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="<?= base_url('barang/tambah_aksi') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Contoh: BRG-001"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Nama barang"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" placeholder="0" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" name="harga" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT BARANG     -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditLabel">Edit Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('barang/edit_aksi') ?>" method="post">
                    <div class="modal-body">
                        <!-- Input Hidden untuk ID Barang -->
                        <input type="hidden" name="id_barang" id="edit_id">

                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <!-- Readonly agar kode tidak diubah saat edit -->
                            <input type="text" name="kode_barang" id="edit_kode" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" id="edit_nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" id="edit_kategori" class="form-select" required>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" id="edit_stok" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" name="harga" id="edit_harga" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery (Wajib untuk DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>